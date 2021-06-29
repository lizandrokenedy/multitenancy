<?php

namespace App\Services;

use App\Helpers\Enum\RoleEnum;
use App\Messages\AssessmentMessages;
use App\Models\Assessment;
use App\Repositories\Eloquent\AssessmentRepository;
use Illuminate\Support\Facades\Auth;

class AssessmentService extends AbstractService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AssessmentRepository();
    }


    /**
     * List All
     */
    public function listAll()
    {
        $roleUser = Auth::user()->roles->first();
        if (isset($roleUser) && $roleUser->id === RoleEnum::ALUNO) {
            return $this->repository->listAssessmentByStudent(Auth::id());
        }
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
    public function create(array $data): Assessment
    {
        $data = array_merge($data, ['evaluator_id' => Auth::id()]);
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
