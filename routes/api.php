<?php

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Auth\GenerateTokenController;
use App\Http\Controllers\Me\DeleteMeController;
use App\Http\Controllers\Me\DetailMeController;
use App\Http\Controllers\Me\UpdateMeController;
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
Route::prefix('users')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/{id}', DetailUserController::class)->whereUuid('id')->middleware('role:'.UserRoleEnum::ADMIN->value);
    Route::get('/', ListUsersController::class)->middleware('role:'.UserRoleEnum::ADMIN->value);
    Route::patch('/{id}', UpdateUserController::class)->whereUuid('id')->middleware('role:'.UserRoleEnum::ADMIN->value);
    Route::delete('/{id}', DeleteUserController::class)->whereUuid('id')->middleware('role:'.UserRoleEnum::ADMIN->value);
});

Route::prefix('urls')->middleware('auth:sanctum')->group(function (): void {
    Route::post('/', CreateUrlController::class);
    Route::get('/{id}', DetailUrlController::class)->whereUuid('id');
    Route::delete('/{id}', DeleteUrlController::class)->whereUuid('id');
    Route::get('/', ListUrlsController::class);
    Route::withoutMiddleware('auth:sanctum')->group(function (): void {
        Route::get('/{slug}', RedirectToUrlController::class);
    });
});

Route::prefix('me')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', DetailMeController::class);
    Route::patch('/', UpdateMeController::class);
    Route::delete('/', DeleteMeController::class);
});
