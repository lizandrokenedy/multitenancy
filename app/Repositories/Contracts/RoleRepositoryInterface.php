<?php

namespace App\Repositories\Contracts;

use App\Models\Role;

interface RoleRepositoryInterface
{
    public function query();
    public function save(array $data): Role;
}
