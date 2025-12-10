<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\GenerateTokenController;
use App\Http\Controllers\ListUsersController;
use Illuminate\Support\Facades\Route;

Route::post('/login', GenerateTokenController::class);

Route::post('/users', CreateUserController::class);
Route::prefix('users')->middleware('auth:sanctum')->group(function () {
    Route::get('/{id}', DetailUserController::class);
    Route::get('/', ListUsersController::class);
});
