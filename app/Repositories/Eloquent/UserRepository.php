<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements RepositoryInterface, UserRepositoryInterface
{
    protected $model = User::class;

    public function save(array $data): User
    {
        return $this->model::create($data);
    }

    public function query()
    {
        return $this->model::query();
    }
}
