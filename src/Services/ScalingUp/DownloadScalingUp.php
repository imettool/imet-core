<?php

namespace ImetCore\Services\ScalingUp;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use ImetCore\Models\Imet\ScalingUp\Basket;
use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use ModularForms\Helpers\File\File;
use ModularForms\Helpers\File\Zip;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadScalingUp
{
    use Common;

    public static function zipFile(int $scaling_id): string|BinaryFileResponse
    {
        $files = [];
        $scaling_ups = Basket::query()->where('scaling_up_id', $scaling_id)->get();
        if (count($scaling_ups) > 0) {
            $item = ModelScalingUpAnalysis::query()->where('id', $scaling_id)->first();

            static::checkAuthorization(explode(',', (string) $item->wdpas));

            foreach ($scaling_ups as $record) {
                $files[] = Storage::disk(Basket::BASKET_DISK)->path('').$record->item;
            }

            if (count($files) > 1) {
                $path = Zip::compress($files,
                    'Scaling_up_'.count($files).'_'.Date::now()->format('m-d-Y_hisu').'.zip',
                    false);

                return File::download($path);
            }

            return trans('imet-core::analysis_report.more_than_one_file');

        }

        return '';
    }
}
