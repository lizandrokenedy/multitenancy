<?php

namespace App\Services;

use App\Helpers\Enum\RoleEnum;
use App\Messages\RoleMessages;
use App\Models\Role;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RoleService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new RoleRepository();
    }


    /**
     * List All
     */
    public function listAll()
    {
        return $this->repository->query();
    }

    public function listRoleAccordingToPermission()
    {
        $userLogged = (new UserRepository())->getUserByIdAndRelations(Auth::id());

        $this->validateRecordNotFound($userLogged);

        if ($userLogged->admin) {
            return $this->listAll()->with('roles')->get();
        }

        if ($userLogged->roles[0]->id == RoleEnum::ADMIN_ESCOLA) {
            return $this->repository->roleListAdminSchool();
        }

        return $this->repository->roleListAdminManager();
    }


    private function validateRecordNotFound($registry)
    {
        if (!$registry) {
            throw new Exception(RoleMessages::REGISTRO_NAO_ENCONTRADO);
        }
    }


    /**
     * Find by ID
     *
     * @param integer $id
     * @return void
     */
    public function findById(int $id): Role
    {
        return $this->repository->getRoleAndPermissionsById($id);
    }

    /**
     * Update Registre
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function update(array $data, int $id): Role
    {
        $registry = $this->findById($id);

        $this->validateRecordNotFound($registry);

        return $this->repository->save($data, $id);
    }



    /**
     * Create Registre
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function create(array $data): Role
    {
        return $this->repository->save($data);
    }

    /**
     * Delete Registre
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {

        $registry = $this->findById($id);

        $this->validateRecordNotFound($registry);

        return $this->repository->delete($id);
    }
}
