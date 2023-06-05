<?php

namespace App\Http\Modules\Manufacturers\Controllers;

use App\Http\JsonController;
use App\Http\Modules\Manufacturers\Requests\ManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\JsonResponse;

class ManufacturersUpdateController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $manufacturerId
     * @param ManufacturerRequest $request
     * @return JsonResponse
     */
    public function __invoke($manufacturerId, ManufacturerRequest $request): \Illuminate\Http\JsonResponse
    {
        $manufacturer = Manufacturer::whereId($manufacturerId)->first();

        if (!isset($manufacturer)) {
            return $this->sendError();
        }

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
