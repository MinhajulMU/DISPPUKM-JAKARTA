<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get("/", [FrontController::class,"index"])->name("api/index");

Route::get("/login", [FrontController::class,"login"])->name("login/index");
Route::post("/login", [FrontController::class,"loginSubmit"])->name("login/submit");
Route::get("/recruitment", [FrontController::class, "recruitment"])->name("recruitment");
Route::post("/recruitment/store", [FrontController::class, "recruitmentStore"])->name("recruitment.store");