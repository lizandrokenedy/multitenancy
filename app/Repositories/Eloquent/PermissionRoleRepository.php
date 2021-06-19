<?php

namespace App\Repositories\Eloquent;

use App\Models\PermissionRole;
use App\Repositories\Contracts\PermissionRoleRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

class PermissionRoleRepository extends AbstractRepository
{
    protected $model = PermissionRole::class;

    public function save(array $data): PermissionRole
    {
        return $this->model::create($data);
    }
}
