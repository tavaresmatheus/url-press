<?php

declare(strict_types=1);

namespace App\Repositories\GenericRepository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 * @template TId of string
 */
interface GenericRepositoryInterface
{
    /**
     * @param  TModel  $model
     * @return TModel
     */
    public function create(Model $model): Model;

    /**
     * @param  TId  $id
     * @return TModel
     */
    public function detail(string $id): Model;

    /**
     * @return Collection<int, TModel>
     */
    public function list(): Collection;

    /**
     * @param  TId  $id
     * @param  TModel  $model
     * @return TModel $model
     */
    public function update(string $id, Model $model): Model;

    /**
     * @param  TId  $id
     */
    public function delete(string $id): bool;
}
