<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Exceptions\BusinessLogicException;
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
     * @return User
     */
    public function createUser(array $attributes): User
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

        return $this->userRepository->create($user);
    }
}
