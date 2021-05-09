<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;

class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{
    protected $model = Company::class;

    public function save(array $data): Company
    {
        return $this->model::create($data);
    }

    public function query()
    {
        return $this->model::query();
    }
}
