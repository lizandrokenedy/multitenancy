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
    public function findById(int $id): User
    {
        return $this->repository->getUserByIdAndRelations($id);
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
        $registry = $this->findById($id);

        $address = $registry->address()->first();

        if (!$registry || !$address) {
            throw new Exception(UserMessages::REGISTRO_NAO_ENCONTRADO);
        }

        $formattedData = $this->formatData($data);

        $user = $this->repository->save($formattedData, $id);

        $address->fill($data);

        $address->save();

        return $user;
    }

    private function formatData(array $data): array
    {
        $user = [];

        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['admin'] = $data['admin'] == 'true' ? true : false;
        $user['role_id'] = $data['role_id'] ? $data['role_id'] : [];
        $user['telephone'] = preg_replace('/[^0-9]/', '', $data['telephone']);
        $user['cell'] = preg_replace('/[^0-9]/', '', $data['cell']);

        $user['password'] = Hash::make($data['password']);
        if (isset($data['alter-password']) || !isset($data['id'])) {
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
        $formattedDataForCreateUser = $this->formatData($data);

        $user = $this->repository->save($formattedDataForCreateUser);

        $address = $user->address()->create($data);

        return $user;
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
