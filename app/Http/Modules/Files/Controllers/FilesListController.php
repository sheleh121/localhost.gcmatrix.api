<?php

namespace App\Http\Modules\Files\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Files\FilesQueryFilter;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilesListController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $files = File::with('relatedObject');
        $queryFilter = new FilesQueryFilter($files, $request);
        $files = $queryFilter
            ->apply()
            ->paginate($request->get('per_page') ?? 10);

        return $this->sendResponse(
            [
                'data' => $files,
                'available_filters' => $queryFilter->filters
            ]
        );
    }
}
