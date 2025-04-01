<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success(array $data = null, string $message = null)
    {
        return [
            'success' => 'sucesso',
            'data' => $data
        ];
    }

    public static function fail(array $data = null)
    {
        return [
            'success' => 'falha',
            'data' => $data
        ];
    }

    public static function error(string $message, string $code, array $data = null)
    {
        return [
            'success' => 'erro',
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }
}
