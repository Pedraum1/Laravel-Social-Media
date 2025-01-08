<?php

namespace App\Classes;

use Illuminate\Http\JsonResponse;

class API{

    public static function success(array $data): JsonResponse{
        return response()->json(
            $data,
            200
        );
    }

    public static function failed(string $message): JsonResponse{
        return response()->json(
            $message,
            400
        );
    }

    public static function error(string $error): JsonResponse{
        return response()->json(
            ["Error"=>$error],
            500
        );
    }

    public static function unauthorized(): JsonResponse{
        return response()->json(
            "Unauthorized request",
            401
        );
    }
}