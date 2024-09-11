<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\TestController;

Route::group([
    'prefix' => 'test',
    'as' => 'test.',
    'middleware' => 'auth:api'
], function () {
    Route::get('/', TestController::class
        . '@index')->name('index');
});
