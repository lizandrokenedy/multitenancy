<?php

namespace App\Repositories\Contracts;

use App\Models\PermissionRole;

interface PermissionRoleRepositoryInterface
{
    public function query();
    public function save(array $data): PermissionRole;
}
