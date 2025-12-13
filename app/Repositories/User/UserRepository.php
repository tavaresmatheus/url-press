<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\GenericRepository\GenericRepository;

/**
 * @extends GenericRepository<User, string>
 */
class UserRepository extends GenericRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function detailByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = $this->model->newQuery()
            ->where('email', $email)
            ->first();

        return $user;
    }
}
