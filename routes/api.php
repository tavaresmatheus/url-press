<?php

use App\Http\Controllers\Auth\GenerateTokenController;
use App\Http\Controllers\Url\CreateUrlController;
use App\Http\Controllers\Url\DeleteUrlController;
use App\Http\Controllers\Url\DetailUrlController;
use App\Http\Controllers\Url\ListUrlsController;
use App\Http\Controllers\Url\RedirectToUrlController;
use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\DetailUserController;
use App\Http\Controllers\User\ListUsersController;
use App\Http\Controllers\User\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', GenerateTokenController::class);

Route::post('/users', CreateUserController::class);
Route::prefix('users')->middleware('auth:sanctum')->group(function () {
    Route::get('/{id}', DetailUserController::class)->whereUuid('id');
    Route::get('/', ListUsersController::class);
    Route::patch('/{id}', UpdateUserController::class)->whereUuid('id');
    Route::delete('/{id}', DeleteUserController::class)->whereUuid('id');
});

Route::prefix('urls')->middleware('auth:sanctum')->group(function () {
    Route::post('/', CreateUrlController::class);
    Route::get('/{id}', DetailUrlController::class)->whereUuid('id');
    Route::delete('/{id}', DeleteUrlController::class)->whereUuid('id');
    Route::get('/', ListUrlsController::class);
    Route::withoutMiddleware('auth:sanctum')->group(function () {
        Route::get('/{slug}', RedirectToUrlController::class);
    });
});
