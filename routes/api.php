<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\GenerateTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/users', CreateUserController::class);
Route::post('/login', GenerateTokenController::class);
