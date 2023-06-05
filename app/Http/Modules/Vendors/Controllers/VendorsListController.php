<?php

namespace App\Http\Modules\Vendors\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Vendors\VendorsQueryFilter;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VendorsListController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $vendors = Vendor::with(['manufacturers', 'files'])->withCount(['manufacturers', 'files']);
        $queryFilter = new VendorsQueryFilter($vendors, $request);
        $vendors = $queryFilter
            ->apply()
            ->paginate($request->get('per_page') ?? 10);

        return $this->sendResponse(
            [
                'data' => $vendors,
                'available_filters' => $queryFilter->filters
            ]
        );
    }
}
