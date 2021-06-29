<?php

namespace App\Repositories\Eloquent;

use App\Models\Assessment;

class AssessmentRepository extends AbstractRepository
{
    protected $model = Assessment::class;

    public function save(array $data): Assessment
    {
        return $this->model::create($data);
    }

    public function listAssessmentByStudent($idStudent)
    {
        return $this->model::query()->where('student_id', $idStudent);
    }
}
