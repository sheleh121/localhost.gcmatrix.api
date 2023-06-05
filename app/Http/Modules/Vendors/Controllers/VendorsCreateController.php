<?php

namespace App\Http\Modules\Vendors\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Vendors\Requests\VendorRequest;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class VendorsCreateController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param VendorRequest $request
     * @return JsonResponse
     */
    public function __invoke(VendorRequest $request): \Illuminate\Http\JsonResponse
    {
        $vendor = new Vendor();

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
