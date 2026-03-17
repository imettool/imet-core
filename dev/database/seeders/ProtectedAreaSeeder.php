<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use ImetCore\Exceptions\UpdateFromProtectedPlanetCsvFailed;
use ImetCore\Factories\ProtectedAreaFactory;
use ImetCore\Helpers\ProtectedPlanetCSV;

class ProtectedAreaSeeder extends Seeder
{
    use WithoutModelEvents;

    const int NUM_MODELS = 50;

    private const array SAMPLE_DATA = [
        ['ATA_555548003', 'ATA', '555548003', 'Amanda Bay', 'Ia', '2014', '17.1398876307', '16.9595456934178', '16.9595456934178'],
        ['ATA_14270', 'ATA', '14270', 'Yukidori Zawa, Langhovde, Lützow-Holmbukta', 'Not Reported', '1987', '3.6', '', ''],
        ['ATA_555548090', 'ATA', '555548090', 'Mawson\'s Huts', 'Ia', '2014', '1.0486611421', '1.02186286741104', '1.02186286741104'],
        ['ATA_4781', 'ATA', '4781', 'Green Island, Berthelot Islands, Antarctic Pen.', 'Not Reported', '1966', '0.1', '', ''],
        ['ATA_4780', 'ATA', '4780', 'Dion Islands', 'Not Reported', '1966', '6', '', ''],
        ['ATA_9783', 'ATA', '9783', 'South Bay, Doumer Island, Palmer Archipelago', 'Not Reported', '1987', '1', '', ''],
        ['ATA_555548082', 'ATA', '555548082', 'Larsemann Hills', 'Ia', '2014', '238.9479593248', '236.63725655651', '225.919460812499'],
        ['ATA_1126', 'ATA', '1126', 'Byers Peninsula', 'Not Reported', '1975', '65.7', '', ''],
        ['ATA_14267', 'ATA', '14267', 'Linnaeus Terrace, Asgard Range, Victoria Land', 'Ia', '1985', '3.2', '', ''],
        ['ATA_14265', 'ATA', '14265', 'Clark Peninsula', 'Ia', '1985', '9.82', '', ''],
        ['ATA_555759276', 'ATA', '555759276', 'Mount Harding', 'Ia', '2008', '101.7035624208', '102.779947937805', '0'],
        ['ATA_356926', 'ATA', '356926', 'North-eastern Bailey Peninsula', 'Ia', '2013', '0.2927584394', '0.283819098665503', '0'],
        ['ATA_354469', 'ATA', '354469', 'Clark Peninsula', 'Ia', '2000', '9.6769107961', '9.37875688947589', '0'],
        ['ATA_14263', 'ATA', '14263', 'Cierva Point', 'Not Reported', '1985', '51.8', '', ''],
        ['ATA_124391', 'ATA', '124391', 'Archipel de Pointe Géologie, Terre Adélie', 'Ia', '1995', '2', '', ''],
        ['ATA_1123', 'ATA', '1123', 'Barwick Valley', 'Ia', '1975', '279', '', ''],
        ['ATA_33403', 'ATA', '33403', 'Lions Rump, King George I., South Shetland Is.', 'Not Reported', '1991', '1.3', '', ''],
        ['ATA_14254', 'ATA', '14254', 'Northern Coronation Island', 'Not Reported', '1985', '88.5', '', ''],
        ['ATA_555599260', 'ATA', '555599260', 'Stornes', 'Ia', '2014', '21.3128266924', '21.1093345619928', '21.1093345619928'],
        ['ATA_14259', 'ATA', '14259', 'Tramway Ridge, Mount Erebus, Ross Island', 'Ia', '1985', '0.01', '', ''],
        ['ATA_9398', 'ATA', '9398', 'Arrival Heights, Hut Point Peninsula, Ross Island', 'Ia', '1975', '1.1', '', ''],
        ['ATA_14269', 'ATA', '14269', 'Parts of Deception Island, South Shetland Islands', 'Not Reported', '1985', '1.7', '', ''],
        ['ATA_14262', 'ATA', '14262', 'Harmony Point, W. coast Nelson I., S. Shetland Is.', 'Not Reported', '1985', '4', '', ''],
        ['ATA_4771', 'ATA', '4771', 'Fildes Peninsula, King George I., S. Shetland Is.', 'Not Reported', '1975', '1.8', '', ''],
        ['ATA_555548066', 'ATA', '555548066', 'Hawker Island', 'Ia', '2011', '2.2065940805', '2.17444360699155', '2.17444360699155'],
        ['ATA_4785', 'ATA', '4785', 'Southern Powell Island and adjacent Islands', 'Not Reported', '1966', '18', '', ''],
        ['ATA_14272', 'ATA', '14272', 'Summit of Mount Melbourne, northern Victoria Land', 'Ia', '1987', '8.4', '', ''],
        ['ATA_30824', 'ATA', '30824', 'Ablation Point-Ganymede Heights', 'Ia', '1989', '186', '', ''],
        ['ATA_4774', 'ATA', '4774', 'Haswell Island', 'Not Reported', '1975', '1', '', ''],
        ['ATA_357128', 'ATA', '357128', 'Rookery Islands', 'Ia', '2015', '0.8527201802', '0.834457976822388', '0.431482121768388'],
    ];

    /**
     * Run the database seeders using Sample data
     * @throws UpdateFromProtectedPlanetCsvFailed
     */
    public function runWithSample(): void
    {
        // Run on CSV file if exists, otherwise use sample data
        $csvFilePath = database_path('WDPA_WDOECM_Public_all_csv.csv');
        if(file_exists($csvFilePath)){
            ProtectedPlanetCSV::parseCSVFile($csvFilePath);
            return;
        }

        foreach (self::SAMPLE_DATA as $species){
            ProtectedAreaFactory::new()->create([
                'global_id' => $species[0],
                'country' => $species[1],
                'wdpa_id' => $species[2],
                'name' => $species[3],
                'iucn_category' => $species[4],
                'creation_date' => $species[5],
                'perimeter' => $species[6],
                'area' => $species[7],
                'shape_index' => $species[8]
            ]);
        }

    }

    /**
     * Run the database seeders using the ProtectedAreaFactory
     */
    public function runWithFactory(?int $num = self::NUM_MODELS): void
    {
        ProtectedAreaFactory::new()
            ->count($num)
            ->create();
    }
}
