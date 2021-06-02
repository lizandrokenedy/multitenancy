<?php

namespace App\Services;

use App\Messages\RoleMessages;
use App\Models\Role;
use App\Repositories\Eloquent\RoleRepository;
use Exception;
use Illuminate\Support\Facades\DB;

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


    /**
     * Find by ID
     *
     * @param integer $id
     * @return void
     */
    public function findById(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update Registre
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function update(array $data, int $id): bool
    {
        $registry = $this->findById($id);

        if (!$registry) {
            throw new Exception(RoleMessages::REGISTRO_NAO_ENCONTRADO);
        }

        return $this->repository->update($data, $id);
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

        $role = DB::transaction(function () use ($data) {
            $roleCreated = $this->repository->save($data);

            (new PermissionRoleService())->createPermissionForRole($roleCreated->id, $data['permissions']);

            return $roleCreated;
        });



        return $role;
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

        if (!$registry) {
            throw new Exception(RoleMessages::REGISTRO_NAO_ENCONTRADO);
        }

        return $this->repository->delete($id);
    }
}
