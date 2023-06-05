<?php

namespace App\Http\Modules\Manufacturers\Controllers;


use App\Http\JsonController;
use Illuminate\Http\JsonResponse;
use App\Models\Manufacturer;

class ManufacturersGetController extends JsonController
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @return JsonResponse
     */
    public function __invoke($id): \Illuminate\Http\JsonResponse
    {
        $manufacturer = Manufacturer::whereId($id)
            ->withCount(['files', 'vendors'])
            ->with(['files', 'vendors'])
            ->first();

        if (!isset($manufacturer)) {
            return $this->sendError();
        }

        return $this->sendResponse([
            'manufacturer' => $manufacturer,
        ]);
    }
}
