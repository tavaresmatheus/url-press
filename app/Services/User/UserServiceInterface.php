<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param  array<string, mixed>  $attributes
     * @return User
     */
    public function createUser(array $attributes): User;

    /**
     * @param  string  $id
     * @return User
     */
    public function detailUser(string $id): User;
}
