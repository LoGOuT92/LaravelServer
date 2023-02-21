<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChannelController;


Route::get('/channels', [ChannelController::class, 'index']);

Route::post('/channels', [ChannelController::class, 'store']);

Route::put('/channels/{id}', [ChannelController::class, 'update']);

Route::delete('/channels/{id}', [ChannelController::class, 'destroy']);