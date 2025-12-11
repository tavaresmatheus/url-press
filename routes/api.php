<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\GenerateTokenController;
use App\Http\Controllers\ListUsersController;
use App\Http\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', GenerateTokenController::class);

Route::post('/users', CreateUserController::class);
Route::prefix('users')->middleware('auth:sanctum')->group(function () {
    Route::get('/{id}', DetailUserController::class)->whereUuid('id');
    Route::get('/', ListUsersController::class);
    Route::patch('/{id}', UpdateUserController::class)->whereUuid('id');
    Route::delete('/{id}', DeleteUserController::class)->whereUuid('id');
});
