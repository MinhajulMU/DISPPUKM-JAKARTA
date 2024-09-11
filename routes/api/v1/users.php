<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\UsersController;

Route::group([
    'prefix' => 'users',
    'as' => 'users.',
    'middleware' => 'auth:api'
], function () {
    Route::get('/', UsersController::class
        . '@index')->name('index');
});
