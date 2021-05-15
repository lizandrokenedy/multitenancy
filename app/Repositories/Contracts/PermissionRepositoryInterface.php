<?php

namespace App\Repositories\Contracts;

use App\Models\Permission;

interface PermissionRepositoryInterface
{
    public function query();
    public function save(array $data): Permission;
}
