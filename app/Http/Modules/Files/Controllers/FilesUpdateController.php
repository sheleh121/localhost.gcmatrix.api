<?php

namespace App\Http\Modules\Files\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Files\Requests\FileUpdateRequest;
use App\Models\File;
use Illuminate\Http\JsonResponse;

class FilesUpdateController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $fileId
     * @param FileUpdateRequest $request
     * @return JsonResponse
     */
    public function __invoke($fileId, FileUpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = File::whereId($fileId)->first();

        if (!isset($file)) {
            return $this->sendError();
        }

        $file->name = $request->get('name');
        $file->save();

        return $this->sendResponse([
            'file' => File::whereId($file->id)->with('relatedObject')->first(),
        ]);
    }
}
