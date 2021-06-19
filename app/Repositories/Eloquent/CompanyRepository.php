<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

class CompanyRepository extends AbstractRepository
{
    protected $model = Company::class;

    public function save(array $data): Company
    {
        return $this->model::create($data);
    }
}
