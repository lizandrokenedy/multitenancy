<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RoleRepository extends AbstractRepository implements RepositoryInterface, RoleRepositoryInterface
{
    protected $model = Role::class;

    public function query()
    {
        return $this->model::query();
    }


    public function save(array $data, int $id = 0): Role
    {
        if ($id != 0) {
            return DB::transaction(function () use ($data, $id) {
                $registry = $this->model::find($id);
                $registry->update($data);
                $registry->permissions()->sync($data['permissions']);
                return $registry;
            });
        }
        return DB::transaction(function () use ($data) {
            $registry = $this->model::create($data);
            $registry->permissions()->attach($data['permissions']);
            return $registry;
        });
    }

    public function getRoleAndPermissionsById(int $idRole)
    {
        return $this->model::where('id', $idRole)
            ->with('permissions:id')
            ->first();
    }
}
