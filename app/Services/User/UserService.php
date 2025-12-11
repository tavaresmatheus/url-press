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
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected Hasher $hash
    ) {
        $this->userRepository = $userRepository;
        $this->hash = $hash;
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return UserResource
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
        if ($emailAlreadyExists !== null) {
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

    /**
     * @param  string  $id
     * @return UserResource
     */
    public function detailUser(string $id): UserResource
    {
        return new UserResource($this->userRepository->detail($id));
    }

    /**
     * @return UserCollection
     */
    public function listUsers(): UserCollection
    {
        $users = $this->userRepository->list();

        return new UserCollection($users);
    }

    /**
     * @param string $id
     * @param array<string, mixed> $attributes
     * @return UserResource
     */
    public function updateUser(string $id, array $attributes): UserResource
    {
        $user = new User($attributes);

        return new UserResource($this->userRepository->update($id, $user));
    }
}
