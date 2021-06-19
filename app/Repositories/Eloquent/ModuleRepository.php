<?php

namespace App\Repositories\Eloquent;

use App\Models\Module;
use App\Repositories\Contracts\ModuleRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

class ModuleRepository extends AbstractRepository
{
    protected $model = Module::class;

    public function save(array $data): Module
    {
        return $this->model::create($data);
    }
}
