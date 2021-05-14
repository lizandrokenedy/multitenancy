<?php

namespace App\Services;

use App\Repositories\Eloquent\RoleRepository;

class RoleService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new RoleRepository();
    }
}
