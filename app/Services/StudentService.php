<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;

class StudentService extends AbstractService
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
        return $this->repository->getAllStudents();
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
    public function update(array $data, int $id): bool
    {
        $registry = $this->findById($id);

        $this->validateRecordNotFound($registry);

        $idSchool = isset($data['school']) ? $data['school'] : [];

        $registry->studentsSchool()->sync($idSchool);

        return true;
    }


    public function listStudentSchool(int $idSchool)
    {
        return $this->repository->getStudentSchool($idSchool);
    }
}
