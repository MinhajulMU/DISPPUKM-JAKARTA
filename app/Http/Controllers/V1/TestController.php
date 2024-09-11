<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class TestController extends Controller
{
    //
    public function index(): JsonResponse
    {
        return Response::success(data: []);
    }
}
