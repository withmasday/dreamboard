<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function send_response($message, $data)
    {
        $data = [
            'code' => 200,
            'success' => true,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($data, 200);
    }

    public function send_error($message, $data, $code = '')
    {
        if ($code == '') {
            $code = 404;
        }

        $data = [
            'code' => $code,
            'success' => false,
            'message' => $message,
            'errors' => $data
        ];

        return response()->json($data, $code);
    }
}
