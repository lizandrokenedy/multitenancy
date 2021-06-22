<?php

namespace App\Repositories\Eloquent;

use App\Helpers\Enum\RoleEnum;
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

    public function getUserByIdAndRelations(int $idUser)
    {
        return $this->model::where('id', $idUser)
            ->with(['roles.permissions', 'address'])
            ->first();
    }

    public function userListAdminManager()
    {
        return $this->model::with('roles')
            ->where('admin', 0)
            ->whereHas('roles', function ($q) {
                $q->where('id', '<>', RoleEnum::ADMIN_GESTOR);
            })
            ->get();
    }

    public function userListAdminSchool()
    {
        return $this->model::with('roles')
            ->where('admin', 0)
            ->whereHas('roles', function ($q) {
                $q->whereNotIn('id', [RoleEnum::ADMIN_GESTOR, RoleEnum::ADMIN_ESCOLA]);
            })
            ->get();
    }


    public function getAllManagers()
    {
        return $this->model::with('roles')
            ->where('admin', 0)
            ->whereHas('roles', function ($q) {
                $q->where('id', RoleEnum::ADMIN_GESTOR);
            })
            ->get();
    }


    public function getSchoolManagersById($idSchool)
    {
        return $this->model::whereHas('userManager', function ($q) use ($idSchool) {
            $q->where('school_id', $idSchool);
        })->get();
    }
}
