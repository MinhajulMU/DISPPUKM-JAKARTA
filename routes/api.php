<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Helpers\Response;

Route::get('/', function (Request $request) {
    return Response::success(data: []);
});

Route::post('login', AuthController::class
. '@login')->name('login');
