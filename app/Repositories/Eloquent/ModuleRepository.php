<?php

namespace App\Repositories\Eloquent;

use App\Models\Module;

class ModuleRepository extends AbstractRepository
{
    protected $model = Module::class;

    public function save(array $data): Module
    {
        return $this->model::create($data);
    }
}
