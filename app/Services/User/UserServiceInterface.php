<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;

interface UserServiceInterface
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createUser(array $attributes): UserResource;

    public function detailUser(string $id): UserResource;

    public function listUsers(): UserCollection;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateUser(string $id, array $attributes): UserResource;

    public function deleteUser(string $id): bool;
}
