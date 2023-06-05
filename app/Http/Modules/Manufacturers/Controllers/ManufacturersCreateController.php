<?php

namespace App\Http\Modules\Manufacturers\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Manufacturers\Requests\ManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\JsonResponse;

class ManufacturersCreateController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param ManufacturerRequest $request
     * @return JsonResponse
     */
    public function __invoke(ManufacturerRequest $request): \Illuminate\Http\JsonResponse
    {
        $manufacturer = new Manufacturer();

        try {
            $manufacturer->updateFromRequest($request);
        } catch (\Throwable $e) {
            return $this->sendError(500, trans('main.errors.related_error', ['exception_message' => $e]));
        }

        return $this->sendResponse([
            'manufacturer' => $manufacturer,
        ]);
    }
}
