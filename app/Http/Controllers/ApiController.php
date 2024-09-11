<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Response;

class ApiController extends Controller
{
    //
    public function index()
    {
        $data = [
            'system_time' => date('Y-m-d H:i:s'),
            'service' => config('app.name'),
            'env' => config('app.env'),
        ];

        return Response::success(data: $data);
    }
}
