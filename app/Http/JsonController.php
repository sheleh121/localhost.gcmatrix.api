<?php

namespace App\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class JsonController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message ?? trans('main.success'),
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @param int $code
     * @param null $error
     * @return JsonResponse
     */
    public function sendError(int $code = 404, $error = null, $data = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'data' => $data ?? [],
            'success' => false,
            'message' => $error ?? 'Error',
        ];

        if (isset($error)) {
            $response['errors'] = ['main_errors' => [$error]];
        } else if ($code === 404) {
            $response['errors'] = ['main_errors' => trans('main.errors.404')];
        } else {
            $response['errors'] = ['main_errors' => 'main.errors.400'];
        }

        return response()->json($response, $code);
    }
}
