<?php

namespace App\Repositories\Eloquent;

use App\Models\School;
use App\Repositories\Contracts\SchoolRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

class SchoolRepository extends AbstractRepository
{
    protected $model = School::class;

    public function save(array $data): School
    {
        return $this->model::create($data);
    }
}
