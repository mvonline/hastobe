<?php

use App\Http\Controllers\rateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/rate',[rateController::class,"rateCalculator"]);
Route::post('/rate_async',[rateController::class,"rateCalculatorAsync"]);
