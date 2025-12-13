<?php

declare(strict_types=1);

namespace App\Repositories\Url;

use App\Models\Url;
use App\Repositories\GenericRepository\GenericRepositoryInterface;

/**
 * @extends GenericRepositoryInterface<Url, string>
 */
interface UrlRepositoryInterface extends GenericRepositoryInterface
{
    public function detailUrlBySlug(string $slug): Url;

    public function incrementAccesses(string $id): void;
}
