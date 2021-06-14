<?php

namespace App\Repositories\Eloquent;

use App\Models\Address;

class AddressRepository extends AbstractRepository
{
    protected $model = Address::class;

    public function query()
    {
        return $this->model::query();
    }
}
