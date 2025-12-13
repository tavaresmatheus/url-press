<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Exceptions\BusinessLogicException;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Hashing\Hasher;

class UserService implements UserServiceInterface
{
    public function __construct(protected UserRepositoryInterface $userRepository, protected Hasher $hash) {}

    /**
     * @param  array<string, mixed>  $attributes
     *
     * @throws BusinessLogicException
     */
    public function createUser(array $attributes): UserResource
    {
        $userEmail = $attributes['email'];
        if (! is_string($userEmail)) {
            throw new BusinessLogicException('Invalid email.');
        }

        $emailAlreadyExists = $this->userRepository->detailByEmail($userEmail);
        if ($emailAlreadyExists instanceof \App\Models\User) {
            throw new BusinessLogicException('Couldn\'t create the user.');
        }

        $password = $attributes['password'];
        if (! is_string($password)) {
            throw new BusinessLogicException('Invalid password.');
        }

        $attributes['password'] = $this->hash->make($password);
        $user = new User($attributes);

        return new UserResource($this->userRepository->create($user));
    }

    public function detailUser(string $id): UserResource
    {
        return new UserResource($this->userRepository->detail($id));
    }

    public function listUsers(): UserCollection
    {
        $users = $this->userRepository->list();

        return new UserCollection($users);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateUser(string $id, array $attributes): UserResource
    {
        $user = $this->userRepository->detail($id);
        $user->fill($attributes);

        return new UserResource($this->userRepository->update($id, $user));
    }

    public function deleteUser(string $id): bool
    {
        $userResource = $this->detailUser($id);

        $userModel = $userResource->resource;

        $wasDeleted = $this->userRepository->delete((string) $userModel->id);
        if (! $wasDeleted) {
            throw new BusinessLogicException('Coudn\'t delete user.');
        }

        return $wasDeleted;
    }
}
