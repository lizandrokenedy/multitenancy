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

    public function queryDataTable(array $params, array $order)
    {

        return $this->model::when($params, function ($query, $params) {
            if (isset($params) && isset($params['search']['value'])) {
                foreach ($params['columns'] as $param) {
                    $query->orWhere($param['name'], 'like', '%' . $params['search']['value'] . '%');
                }
            }
        })
            ->orderBy($order['column'], $order['order'])
            ->skip($params['start'])
            ->take($params['length'])
            ->get();
    }
}
