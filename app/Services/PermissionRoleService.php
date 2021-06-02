<?php

namespace App\Services;

use App\Repositories\Eloquent\PermissionRoleRepository;

class PermissionRoleService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PermissionRoleRepository();
    }

    public function create(array $data)
    {
        return $this->repository->save($data);
    }

    public function createPermissionForRole(int $roleId, array $permissions)
    {
        foreach ($permissions as $permission) {
            $this->create([
                'role_id' => $roleId,
                'permission_id' => $permission
            ]);
        }
    }

    private function cleanPermissionsRole(int $roleId)
    {
    }
}
