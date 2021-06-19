<?php

namespace App\Repositories\Eloquent;

use App\Helpers\Enum\RoleEnum;
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

        // dd($data);
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

    public function roleListAdminManager()
    {
        return $this->model::where('id', '<>', RoleEnum::ADMIN_GESTOR)
            ->whereHas('users', function ($q) {
                $q->where('admin', 0);
            })
            ->get();
    }

    public function roleListAdminSchool()
    {
        return $this->model::whereNotIn('id', [RoleEnum::ADMIN_GESTOR, RoleEnum::ADMIN_ESCOLA])
            ->whereHas('users', function ($q) {
                $q->where('admin', 0);
            })
            ->get();
    }
}
