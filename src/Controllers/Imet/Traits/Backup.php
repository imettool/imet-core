<?php

/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Controllers\Imet\Traits;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use ImetCore\Helpers\ImetEnv;
use ImetCore\Models\Imet;
use ImetCore\Models\ProtectedAreaNonWdpa;

trait Backup
{
    private $BACKUP_FOLDER = 'backups';

    private $MAX_NUM_BACKUPS = 5;  // per each imet

    private $MIN_MINUTES_DIFF = 90;

    /**
     * Perform IMET backup if necessary (analyze existing ones)
     */
    public function backup($item, string $version): void
    {
        if (ImetEnv::isImetOfflineEnv()) {

            if ($version === Imet\Imet::IMET_V1) {
                $form = (new Imet\v1\Imet)->find($item);
            } elseif ($version === Imet\Imet::IMET_OECM) {
                $form = (new Imet\oecm\Imet)->find($item);
            } else {
                $form = (new Imet\v2\Imet)->find($item);
            }

            $now = Date::now();
            $fileName = $this->backup_filename($form, $now);

            // Retrieve existing backups
            $form_backups = $this->retrieve_existing_backups($item);
            $num_backups = count($form_backups);

            // no previous backups exist
            if ($num_backups === 0) {
                $this->execute_backup($form, $fileName);
            }
            // previous backups exist
            else {
                $oldest_backup = reset($form_backups);
                $last_backup = last($form_backups);
                $bck_name_array = explode('_', str_replace('.json', '', $last_backup));
                $bck_date = $bck_name_array[count($bck_name_array) - 1];
                $bck_date = Date::createFromFormat('Y-m-d-H-i-s', $bck_date);
                // More than $MIN_MINUTES_DIFF from last backup
                if ($bck_date->diffInMinutes($now) > $this->MIN_MINUTES_DIFF) {
                    // remove oldest backup when max num reached
                    if ($num_backups >= $this->MAX_NUM_BACKUPS) {
                        Storage::delete($oldest_backup);
                    }

                    $this->execute_backup($form, $fileName);
                }
            }

        }
    }

    /**
     * Generate a filename for the backup
     */
    private function backup_filename($form, $now): string
    {
        $wdpa_id = ProtectedAreaNonWdpa::isNonWdpa($form->wdpa_id) ? '' : '_'.$form->wdpa_id;

        return 'IMET'.
            $wdpa_id.
            '_'.$form->Year.
            '_'.$form->FormID.
            '_'.$now->format('Y-m-d-H-i-s').
            '.json';
    }

    /**
     * Retrieve existing backups from filesystem
     */
    private function retrieve_existing_backups($imet_id): array
    {
        $all_backups = Storage::files($this->BACKUP_FOLDER);
        asort($all_backups);
        $form_backups = [];
        foreach ($all_backups as $backup) {
            $bck_name_array = explode('_', str_replace('.json', '', $backup));
            $bck_form_id = $bck_name_array[count($bck_name_array) - 2];
            if ($bck_form_id === $imet_id) {
                $form_backups[] = $backup;
            }
        }

        return $form_backups;
    }

    private function execute_backup($form, string $filename): void
    {
        if (! Storage::exists($this->BACKUP_FOLDER)) {
            Storage::makeDirectory($this->BACKUP_FOLDER);
        }

        $json = $this->export($form, false, false, false);
        $handle = fopen(Storage::path($this->BACKUP_FOLDER).'/'.$filename, 'w');
        fwrite($handle, json_encode($json));
        fclose($handle);
    }
}
