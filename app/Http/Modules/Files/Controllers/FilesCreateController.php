<?php

namespace App\Http\Modules\Files\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Files\Requests\FileCreateRequest;
use App\Models\File;
use Illuminate\Http\JsonResponse;

class FilesCreateController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param FileCreateRequest $request
     * @return JsonResponse
     */
    public function __invoke(FileCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = new File();
        $file->related_id = $request->get('related_id');
        $file->related_type = $request->get('related_type');
        $file->name = $request->get('name');
        $file->save();

        return $this->sendResponse([
            'file' => $file,
        ]);
    }
}
