<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends AbstractRepository implements RepositoryInterface, RoleRepositoryInterface
{
    protected $model = Role::class;
}
