<?php

use App\Http\Controllers\API\CancelNumberAction;
use App\Http\Controllers\API\GetNumberAction;
use App\Http\Controllers\API\GetSMSAction;
use App\Http\Controllers\API\GetStatusAction;
use Illuminate\Support\Facades\Route;

Route::get('/getNumber', [GetNumberAction::class, 'index']);
Route::get('/getSms', [GetSMSAction::class, 'index']);
Route::get('/cancelNumber', [CancelNumberAction::class, 'index']);
Route::get('/getStatus', [GetStatusAction::class, 'index']);
