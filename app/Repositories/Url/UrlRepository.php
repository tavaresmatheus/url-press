<?php

declare(strict_types=1);

namespace App\Repositories\Url;

use App\Models\Url;
use App\Repositories\GenericRepository\GenericRepository;

/**
 * @extends GenericRepository<Url, string>
 */
class UrlRepository extends GenericRepository implements UrlRepositoryInterface
{
    public function __construct(Url $model)
    {
        parent::__construct($model);
    }
}
