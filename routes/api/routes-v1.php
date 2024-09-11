<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use App\Helpers\Route as RecursiveRoute;

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get("/", [ApiController::class,"index"])
        ->name("api/index");
});

RecursiveRoute::loadFromDir(__DIR__ . '/v1');
