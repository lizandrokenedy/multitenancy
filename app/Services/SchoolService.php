<?php

namespace App\Services;

use App\Models\School;
use App\Repositories\Eloquent\SchoolRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\DB;

class SchoolService extends AbstractService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new SchoolRepository();
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
    public function findById(int $id): School
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

        $address = $registry->address()->first();

        $school = $this->repository->update($data, $id);

        if (!$address) {
            $school->address()->create($data);
            return $school;
        }

        $address->fill($data);
        $address->save();

        $idManagers = isset($data['idmanagers']) ? $data['idmanagers'] : [];

        $registry->managers()->sync($idManagers);

        return $school;
    }



    /**
     * Create Registre
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function create(array $data): School
    {
        $school = $this->repository->save($data);

        $school->address()->create($data);

        $idManagers = isset($data['idmanagers']) ? $data['idmanagers'] : [];

        $school->managers()->sync($idManagers);

        return $school;
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
