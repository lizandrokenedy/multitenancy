<?php

namespace App\Services;

use App\Messages\PermissionMessages;
use App\Models\Module;
use App\Models\Permission;
use App\Repositories\Eloquent\PermissionRepository;
use Illuminate\Support\Str;
use Exception;

class PermissionService
{
    private $repository;
    private $messages;

    public function __construct()
    {
        $this->repository = new PermissionRepository();
        $this->messages = new PermissionMessages();
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

    private function formatData(Module $module)
    {
        $slug = Str::slug($module->name, "-");

        return [
            ['slug' => "tela-{$slug}-editar", 'name' => 'Editar', 'module_id' => $module->id],
            ['slug' => "tela-{$slug}-visualizar", 'name' => 'Visualizar', 'module_id' => $module->id],
            ['slug' => "tela-{$slug}-excluir", 'name' => 'Excluir', 'module_id' => $module->id],
            ['slug' => "tela-{$slug}-criar", 'name' => 'Criar', 'module_id' => $module->id],
        ];
    }

    public function createPermissionsForModule(Module $module)
    {
        $permissions = $this->formatData($module);

        foreach ($permissions as $permission) {
            $this->create($permission);
        }
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
            throw new Exception($this->messages::REGISTRO_NAO_ENCONTRADO);
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
    public function create(array $data): Permission
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

        if (!$registry) {
            throw new Exception($this->messages::REGISTRO_NAO_ENCONTRADO);
        }

        return $this->repository->delete($id);
    }
}
