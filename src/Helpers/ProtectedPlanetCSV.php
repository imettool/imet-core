<?php

namespace ImetCore\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;
use ImetCore\Exceptions\ExtractionFromArchiveFailed;
use ImetCore\Exceptions\UpdateFromProtectedPlanetCsvFailed;
use ImetCore\Models\ProtectedArea;
use Throwable;
use ZipArchive;

class ProtectedPlanetCSV
{
    const int CHUNK_SIZE = 200;

    const string LEGACY_GLOBAL_IDS_FILE = 'legacy_global_ids.csv';

    /**
     * Update protected areas from a CSV file downloaded from Protected Planet website.
     *
     * @throws Throwable
     */
    public static function updateFromCSV(string $sourcePath, ?callable $afterChunkExecution = null): void
    {
        // If the source path is a ZIP file, extract the CSV file from it
        if (str_ends_with($sourcePath, '.zip')) {
            $csvPath = self::extractZip($sourcePath);
        }
        // Otherwise, assume it's a CSV file
        elseif (str_ends_with($sourcePath, '.csv')) {
            $csvPath = $sourcePath;
        } else {
            throw new ExtractionFromArchiveFailed('unsupported file format: '.$sourcePath);
        }

        self::parseCSVFile($csvPath, $afterChunkExecution);
    }

    /**
     * Parse the CSV file and upsert protected areas into the database
     *
     * @throws UpdateFromProtectedPlanetCsvFailed
     */
    public static function parseCSVFile(string $csvFilePath, ?callable $afterChunkExecution = null): void
    {
        $legacyGlobalIds = self::getLegacyGlobalIDs();

        $generator = new CSVReader($csvFilePath);
        foreach ($generator->rows(self::CHUNK_SIZE) as $idx => $chunk) {
            /** @var array<int, array<string, mixed>> $chunk */
            $data = collect($chunk)
                ->map(fn (array $item): ?array => self::parseProtectedArea($item, $legacyGlobalIds))
                ->filter()
                ->all();
            $progress_status = self::calculateProgressStatus($generator->num_rows, $idx);
            // Execute upsert
            try {
                ProtectedArea::query()
                    ->upsert($data, ['global_id']);
            } catch (Exception) {
                throw new UpdateFromProtectedPlanetCsvFailed('error while upserting protected areas');
            }

            // Optionally, execute a callback after each upsert
            if ($afterChunkExecution !== null) {
                $afterChunkExecution($progress_status);
            }
        }
    }

    /**
     * Parse a single protected area from a CSV item and prepare it for upsert
     */
    private static function parseProtectedArea(array $csv_item, array $legacyGlobalIds): ?array
    {
        $wdpa_id_key = array_key_exists('WDPAID', $csv_item)
            ? 'WDPAID' : 'SITE_ID';

        if ($csv_item['ISO3'] === 'ABNJ') { // Skip "Areas Beyond National Jurisdiction"
            return null;
        }

        // Determine the global_id, using legacy IDs if available
        if (array_key_exists($csv_item[$wdpa_id_key], $legacyGlobalIds)) {
            $global_id = $legacyGlobalIds[$csv_item[$wdpa_id_key]];
        } else {
            $global_id = $csv_item['ISO3'] !== null && $csv_item[$wdpa_id_key] !== null
                ? $csv_item['ISO3'].'_'.$csv_item[$wdpa_id_key]
                : null;
        }

        return [
            'global_id' => $global_id,
            'country' => $csv_item['ISO3'] ?? null,
            'wdpa_id' => $csv_item[$wdpa_id_key] ?? null,
            'name' => $csv_item['NAME'] ?? null,
            'iucn_category' => $csv_item['IUCN_CAT'] ?? null,
            'creation_date' => $csv_item['STATUS_YR'] ?? null,
            'perimeter' => $csv_item['REP_AREA'] ?? null,
            'area' => $csv_item['GIS_AREA'] ?? null,
            'shape_index' => $csv_item['GIS_M_AREA'] ?? null,
        ];
    }

    /**
     * Retrieve legacy global IDs from a CSV file as an associative array [wdpa_id => global_id]
     */
    public static function getLegacyGlobalIDs(?callable $afterChunkExecution = null): array
    {
        $csvFilename = __DIR__.'/../database/'.self::LEGACY_GLOBAL_IDS_FILE;

        $legacyGlobalIds = array_map(str_getcsv(...), file($csvFilename));
        array_walk($legacyGlobalIds, function (&$a) use ($legacyGlobalIds): void {
            $a = array_combine($legacyGlobalIds[0], $a);
        });
        array_shift($legacyGlobalIds);

        return array_combine(
            array_map(fn (array $item) => $item['wdpa_id'], $legacyGlobalIds),
            array_map(fn (array $item) => $item['global_id'], $legacyGlobalIds)
        );
    }

    /**
     * Extract the CSV file from the ZIP archive downloaded from Protected Planet
     *
     * @throws Throwable
     */
    public static function extractZip(string $zipFilePath): int|string
    {
        // Unzip the file
        $zip = new ZipArchive;
        $zipHandle = $zip->open($zipFilePath, ZipArchive::RDONLY);
        throw_if($zipHandle !== true, ExtractionFromArchiveFailed::class, 'cannot open archive '.$zipFilePath);

        // Locate the CSV file to extract
        // Protected Planet ZIP files contains 2 CSV files and some folders: the first CSV file (the one to extract) contains the list
        // of protected areas with a name like "WDPA_WDOECM_<date>_Public_all_csv.csv" while the second CSV file contains
        // metadata about the dataset named like "WDPA_sources_<date>.csv".
        $csvFilename = null;
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            if (str_ends_with($filename, '.csv') && ! str_contains(basename($filename), 'sources')) {
                $csvFilename = $filename;
                break;
            }
        }

        throw_if($csvFilename === null, ExtractionFromArchiveFailed::class, sprintf('cannot locate CSV file %s in archive %s', $csvFilename, $zipFilePath));

        // Extract the CSV file
        $destinationFilePath = Storage::disk('temp')->path('');
        $zip->extractTo($destinationFilePath, $csvFilename);
        $zip->close();
        throw_unless(file_exists($destinationFilePath), ExtractionFromArchiveFailed::class, sprintf('extraction of archive %s failed', $zipFilePath));

        return $destinationFilePath.$csvFilename;
    }

    /**
     * Calculate the progress status of the job based on the number of rows and the current chunk index
     */
    private static function calculateProgressStatus(int $num_rows, int $chunk_index): int
    {
        $progress = intval((($chunk_index + 1) * self::CHUNK_SIZE / $num_rows) * 100);
        $progress = ($progress / 100 * 80) + 10;     // CSV parsing takes 80% of the job progress, starting from 10%

        return round($progress);
    }
}
