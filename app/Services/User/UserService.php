<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Exceptions\BusinessLogicException;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected Hash $hash
    ) {
        $this->userRepository = $userRepository;
        $this->hash = $hash;
    }

    /**
     * @param array<string, mixed>
     * @return User
     */
    public function createUser(array $attributes): User
    {
        $userEmail = $attributes['email'];
        $emailAlreadyExists = $this->userRepository->detailByEmail($userEmail);
        if ($emailAlreadyExists !== null) {
            throw new BusinessLogicException('Couldn\'t create the user.');
        }

        $user = new User(
            $attributes['name'],
            $userEmail,
            $this->hash->make($attributes['password']),
        );

        return $this->userRepository->create($user);
    }
}
