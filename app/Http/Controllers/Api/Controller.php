<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    protected function successResponse($message, $data, array $meta = [])
    {
        return response()->json(
            array_merge([
                'data' => $data
            ], $meta), 200);
    }


    protected function errorResponse($message)
    {
        return response()->json([
            'errors' => (array) $message,
            'success' => false,
        ], 422);
    }

}
