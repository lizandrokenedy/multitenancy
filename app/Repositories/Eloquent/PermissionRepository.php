<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

class PermissionRepository extends AbstractRepository
{
    protected $model = Permission::class;

    public function save(array $data): Permission
    {
        return $this->model::create($data);
    }
}
