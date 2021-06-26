<?php

namespace App\Repositories\Eloquent;

use App\Models\School;
use App\Repositories\Contracts\SchoolRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

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
