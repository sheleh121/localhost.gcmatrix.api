<?php

namespace App\Http\Modules\Vendors\Controllers;


use App\Http\JsonController;
use Illuminate\Http\JsonResponse;
use App\Models\Vendor;

class VendorsGetController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @return JsonResponse
     */
    public function __invoke($id): \Illuminate\Http\JsonResponse
    {
        $vendor = Vendor::whereId($id)
            ->with(['manufacturers', 'files'])
            ->withCount(['manufacturers', 'files'])
            ->first();

        if (!isset($vendor)) {
            return $this->sendError();
        }

        return $this->sendResponse([
            'vendor' => $vendor,
        ]);
    }
}
