<?php

namespace App\Repositories\Eloquent;

use App\Models\PermissionRole;
use App\Repositories\Contracts\PermissionRoleRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

class PermissionRoleRepository extends AbstractRepository implements RepositoryInterface, PermissionRoleRepositoryInterface
{
    protected $model = PermissionRole::class;

    public function query()
    {
        return $this->model::query();
    }

    public function save(array $data): PermissionRole
    {
        return $this->model::create($data);
    }
}
