<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\GenericRepository\GenericRepositoryInterface;

/**
 * @extends GenericRepositoryInterface<User, string>
 */
interface UserRepositoryInterface extends GenericRepositoryInterface
{
    public function detailByEmail(string $email): ?User;
}
