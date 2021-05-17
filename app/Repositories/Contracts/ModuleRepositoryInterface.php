<?php

namespace App\Repositories\Contracts;

use App\Models\Module;

interface ModuleRepositoryInterface
{
    public function query();
    public function save(array $data): Module;
}
