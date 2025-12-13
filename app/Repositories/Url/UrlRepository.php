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

    public function detailUrlBySlug(string $slug): Url
    {
        /** @var Url $url */
        $url = $this->model->newQuery()
            ->where('slug', $slug)
            ->firstOrFail();

        return $url;

    }

    public function incrementAccesses(string $id): void
    {
        /** @var Url $url */
        $url = $this->model->newQuery()
            ->where('id', $id)
            ->firstOrFail();

        $url->newQuery()->increment('accesses');
    }
}
