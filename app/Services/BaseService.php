<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseService
{
    /**
     * @return class-string<Model>
     */
    abstract protected function model(): string;

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Model
    {
        return DB::transaction(fn () => ($this->model())::create($data));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $model, array $data): Model
    {
        return DB::transaction(function () use ($model, $data) {
            $model->update($data);

            return $model;
        });
    }

    public function destroy(Model $model): void
    {
        DB::transaction(fn () => $model->delete());
    }
}
