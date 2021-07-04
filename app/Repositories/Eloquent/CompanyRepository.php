<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;

class CompanyRepository extends AbstractRepository
{
    protected $model = Company::class;

    public function save(array $data): Company
    {
        return $this->model::create($data);
    }
}
