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
}
