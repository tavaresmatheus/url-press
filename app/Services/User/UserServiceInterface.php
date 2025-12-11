<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;

interface UserServiceInterface
{
    /**
     * @param  array<string, mixed>  $attributes
     * @return UserResource
     */
    public function createUser(array $attributes): UserResource;

    /**
     * @param  string  $id
     * @return UserResource
     */
    public function detailUser(string $id): UserResource;

    /**
     * @return UserCollection
     */
    public function listUsers(): UserCollection;

    /**
     * @param string $id
     * @param array<string, mixed> $attributes
     * @return UserResource
     */
    public function updateUser(string $id, array $attributes): UserResource;
}
