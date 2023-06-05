<?php

namespace App\Http\Modules\Vendors\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Vendors\Requests\VendorRequest;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VendorsUpdateController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $vendorId
     * @param VendorRequest $request
     * @return JsonResponse
     */
    public function __invoke($vendorId, VendorRequest $request): \Illuminate\Http\JsonResponse
    {
        $vendor = Vendor::whereId($vendorId)->first();

        if (!isset($vendor)) {
            return $this->sendError();
        }

        try {
            $vendor->updateFromRequest($request);
        } catch (\Throwable $e) {
            return $this->sendError(500, trans('main.errors.related_error', ['exception_message' => $e]));
        }

        return $this->sendResponse([
            'vendor' => Vendor::whereId($vendor->id)->with(['manufacturers', 'files'])->first(),
        ]);
    }
}
