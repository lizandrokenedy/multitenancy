<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

class PermissionRepository extends AbstractRepository implements RepositoryInterface, PermissionRepositoryInterface
{
    protected $model = Permission::class;

    public function query()
    {
        return $this->model::query();
    }


    public function save(array $data): Permission
    {
        return $this->model::create($data);
    }
}
