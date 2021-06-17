<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository extends AbstractRepository implements RepositoryInterface, UserRepositoryInterface
{
    protected $model = User::class;

    public function save(array $data, int $id = 0): User
    {
        if ($id != 0) {
            return DB::transaction(function () use ($data, $id) {
                $registry = $this->model::find($id);
                $registry->update($data);
                $registry->roles()->sync($data['role_id']);

                return $registry;
            });
        }
        return DB::transaction(function () use ($data) {
            $registry = $this->model::create($data);
            $registry->roles()->sync($data['role_id']);

            return $registry;
        });
    }

    public function query()
    {
        return $this->model::query();
    }

    public function getUserByIdAndRelations(int $idUser)
    {
        return $this->model::where('id', $idUser)
            ->with(['roles.permissions', 'address'])
            ->first();
    }
}
