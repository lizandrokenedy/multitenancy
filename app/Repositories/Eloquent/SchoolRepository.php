<?php

namespace App\Repositories\Eloquent;

use App\Models\School;

class SchoolRepository extends AbstractRepository
{
    protected $model = School::class;

    public function save(array $data): School
    {
        return $this->model::create($data);
    }

    public function listSchoolsTeacher(int $idTeacher)
    {
        return $this->model::whereHas('teachersSchool', function ($q) use ($idTeacher) {
            $q->where('teacher_id', $idTeacher);
        })->get();
    }
}
