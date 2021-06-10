<?php

namespace App\Services;

use App\Messages\UserMessages;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
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
        return $this->repository->getUserAndRoleById($id);
    }

    /**
     * Update Registre
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function update(array $data, int $id): User
    {

        $formattedData = $this->formatData($data);

        $registry = $this->findById($id);

        if (!$registry) {
            throw new Exception(UserMessages::REGISTRO_NAO_ENCONTRADO);
        }

        return $this->repository->save($formattedData, $id);
    }

    private function formatData(array $data): array
    {
        $user = [];

        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['admin'] = $data['admin'] == 'true' ? true : false;
        $user['role_id'] = $data['role_id'] ? $data['role_id'] : [];
        // if (isset($data['role_id'])) {
        //     $user['role_id'] = $data['role_id'];
        // }

        if (isset($data['alter-password']) || !isset($data['id'])) {
            $user['password'] = Hash::make($data['password']);
        }

        return $user;
    }



    /**
     * Create Registre
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function create(array $data): User
    {
        $formattedData = $this->formatData($data);

        return $this->repository->save($formattedData);
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
            throw new Exception(UserMessages::REGISTRO_NAO_ENCONTRADO);
        }

        return $this->repository->delete($id);
    }
}
