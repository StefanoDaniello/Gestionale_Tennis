<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CampiController;
use App\Http\Controllers\Api\PrenotazioniController;


Route::get('campi', [CampiController::class,'index']);
Route::get('prenotazioni', [PrenotazioniController::class,'index']);
Route::post('prenotazioni', [PrenotazioniController::class,'store']);
