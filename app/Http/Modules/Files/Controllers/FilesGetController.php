<?php

namespace App\Http\Modules\Files\Controllers;

use App\Http\JsonController;
use Illuminate\Http\JsonResponse;
use App\Models\File;

class FilesGetController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @return JsonResponse
     */
    public function __invoke($id): \Illuminate\Http\JsonResponse
    {
        $file = File::whereId($id)->with('relatedObject')->first();

        if (!isset($file)) {
            return $this->sendError();
        }

        return $this->sendResponse([
            'file' => $file,
        ]);
    }
}
