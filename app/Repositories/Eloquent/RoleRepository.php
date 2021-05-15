<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends AbstractRepository implements RepositoryInterface, RoleRepositoryInterface
{
    protected $model = Role::class;

    public function query()
    {
        return $this->model::query();
    }


    public function save(array $data): Role
    {
        return $this->model::create($data);
    }
}
