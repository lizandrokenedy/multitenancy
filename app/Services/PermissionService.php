<?php

namespace App\Services;

use App\Repositories\Eloquent\PermissionRepository;

class PermissionService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PermissionRepository();
    }
}
