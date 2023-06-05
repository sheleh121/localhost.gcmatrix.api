<?php

namespace App\Http\Modules\Manufacturers\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Manufacturers\ManufacturersQueryFilter;
use App\Models\Manufacturer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManufacturersListController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $manufacturers = Manufacturer::with(['files', 'vendors'])->withCount(['files', 'vendors']);
        $queryFilter = new ManufacturersQueryFilter($manufacturers, $request);
        $manufacturers = $queryFilter
            ->apply()
            ->paginate($request->get('per_page') ?? 10);

        return $this->sendResponse(
            [
                'data' => $manufacturers,
                'available_filters' => $queryFilter->filters
            ]
        );
    }
}
