<?php

namespace App\Http\Modules\Files\Controllers;

use App\Http\JsonController;
use App\Models\File;
use Illuminate\Http\JsonResponse;

class FilesDeleteController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $fileId
     * @return JsonResponse
     */
    public function __invoke($fileId): \Illuminate\Http\JsonResponse
    {
        $file = File::whereId($fileId)->first();

        if (!isset($file)) {
            return $this->sendError();
        }

        $file->delete();

        return $this->sendResponse([]);
    }
}
