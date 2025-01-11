<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class AppResponse
{
    public static function success($data = null, string $message = '', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    public static function error(string $message, int $statusCode = 500): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}