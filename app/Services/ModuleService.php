<?php

namespace App\Services;

use App\Messages\ModuleMessages;
use App\Models\Module;
use App\Repositories\Eloquent\ModuleRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ModuleService extends AbstractService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ModuleRepository();
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

        $this->validateRecordNotFound($registry);

        return $this->repository->update($data, $id);
    }



    /**
     * Create Registre
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function create(array $data): Module
    {
        return $this->repository->save($data);
    }


    public function createModuleAndPermissions(array $data): Module
    {
        return DB::transaction(function () use ($data) {
            $module = $this->create($data);
            (new PermissionService)->createPermissionsForModule($module);
            return $module;
        });
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
