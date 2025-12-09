<?php

declare(strict_types=1);

namespace App\Repositories\GenericRepository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 * @template TId of string
 *
 * @implements GenericRepositoryInterface<TModel, TId>
 */
class GenericRepository implements GenericRepositoryInterface
{
    /**
     * @var TModel
     */
    protected Model $model;

    /**
     * @param  TModel  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param  TModel  $model
     * @return TModel
     */
    public function create(Model $model): Model
    {
        return $this->model->newQuery()->create($model->toArray());
    }

    /**
     * @param  TId  $id
     * @return TModel
     */
    public function detail(string $id): Model
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    /**
     * @return Collection<int, TModel>
     */
    public function list(): Collection
    {
        return $this->model->newQuery()->get();
    }

    /**
     * @param  TId  $id
     * @param  TModel  $model
     * @return TModel
     */
    public function update(string $id, Model $model): Model
    {
        $existing = $this->detail($id);
        $existing->fill($model->getAttributes());
        $existing->save();

        return $existing;
    }

    /**
     * @param  TId  $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $wasDeleted = $this->model->newQuery()->where('id', $id)->delete();
        if (! is_int($wasDeleted) || $wasDeleted <= 0) {
            return false;
        }

        return true;
    }
}
