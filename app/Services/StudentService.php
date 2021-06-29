<?php

namespace App\Services;

use App\Helpers\Enum\RoleEnum;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;

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
        $roleUser = Auth::user()->roles->first();

        if (isset($roleUser) && $roleUser->id === RoleEnum::PROFESSOR) {
            $teacherSchoolsId = Auth::user()->teachersSchool->count() > 0 ? Auth::user()->teachersSchool->pluck('id')->toArray() : [];

            return $this->repository->listStudentsAccordingToTeacherSchools($teacherSchoolsId);
        }
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
