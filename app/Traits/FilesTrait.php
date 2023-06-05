<?php

namespace App\Traits;

use App\Models\File;
use App\Models\Manufacturer;
use App\Models\Vendor;

trait FilesTrait
{
    private function updateFilesFromRequestArray(Manufacturer|Vendor $model, array|null $filesFromRequest): void
    {
        if (!isset($filesFromRequest)) {
            return;
        }

        $files = $model->files;
        foreach ($filesFromRequest as $fileFromRequest) {
            $file = $files->where('id', '=', $fileFromRequest['id'] ?? null)->first();
            if (!isset($file)) {
                $file = $model->files()->make();
            }

            $file->name = $fileFromRequest['name'];
            $file->save();
        }
    }
}
