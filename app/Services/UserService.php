<?php

namespace App\Services;

use App\Helpers\Enum\RoleEnum;
use App\Messages\UserMessages;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserService extends AbstractService
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

    public function listUserAccordingToPermission()
    {
        $userLogged = $this->repository->getUserByIdAndRelations(Auth::id());

        $this->validateRecordNotFound($userLogged);

        if ($userLogged->admin) {
            return $this->listAll()->with('roles')->get();
        }

        if (
            isset($userLogged->roles[0]) &&
            $userLogged->roles[0]->id == RoleEnum::ADMIN_ESCOLA
        ) {
            return $this->repository->userListAdminSchool();
        }

        return $this->repository->userListAdminManager();
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

        $this->validateRecordNotFound($registry);

        $address = $registry->address()->first();

        $formattedData = $this->formatData($data);

        $user = $this->repository->save($formattedData, $id);

        if (!$address) {
            $user->address()->create($data);
            return $user;
        }

        $address->fill($data);
        $address->save();

        return $user;
    }

    private function formatData(array $data): array
    {
        $user = [];

        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['admin'] = isset($data['admin']) && $data['admin'] == 'true' ? true : false;
        $user['role_id'] = $data['role_id'] ? $data['role_id'] : [];
        $user['telephone'] = preg_replace('/[^0-9]/', '', $data['telephone']);
        $user['cell'] = preg_replace('/[^0-9]/', '', $data['cell']);

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
        $formattedDataForCreateUser = $this->formatData($data);

        $user = $this->repository->save($formattedDataForCreateUser);

        $user->address()->create($data);

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

        $this->validateRecordNotFound($registry);

        return $this->repository->delete($id);
    }


    public function getAllManagers()
    {
        return $this->repository->getAllManagers();
    }
}
