<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

Route::get('/', [ChartController::class, 'index']);
Route::post('/', [ChartController::class, 'index']); 