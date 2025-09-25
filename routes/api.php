<?php

use App\Http\Controllers\Api\LengthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConvertController;
use App\Http\Controllers\Api\V1\FinanceController as F;
use App\Http\Controllers\Api\V1\FinanceController;
use App\Http\Controllers\Api\V1\FitnessController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




