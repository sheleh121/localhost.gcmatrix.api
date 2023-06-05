<?php

namespace App\Http\Modules\Vendors\Controllers;

use App\Http\JsonController;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class VendorsDeleteController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $vendorId
     * @return JsonResponse
     */
    public function __invoke($vendorId): \Illuminate\Http\JsonResponse
    {
        $vendor = Vendor::whereId($vendorId)->first();

        if (!isset($vendor)) {
            return $this->sendError();
        }

        $vendor->delete();

        return $this->sendResponse([]);
    }
}
