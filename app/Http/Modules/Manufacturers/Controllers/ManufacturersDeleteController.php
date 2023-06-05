<?php

namespace App\Http\Modules\Manufacturers\Controllers;

use App\Http\JsonController;
use App\Models\Manufacturer;
use Illuminate\Http\JsonResponse;

class ManufacturersDeleteController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $manufacturerId
     * @return JsonResponse
     */
    public function __invoke($manufacturerId): \Illuminate\Http\JsonResponse
    {
        $manufacturer = Manufacturer::whereId($manufacturerId)->first();

        if (!isset($manufacturer)) {
            return $this->sendError();
        }

        $manufacturer->delete();

        return $this->sendResponse([]);
    }
}
