<?php

namespace App\Services;

use App\Repositories\Eloquent\CompanyRepository;

class CompanyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository;
    }

    public function listar()
    {
        return $this->repository->all();
    }


    public function findById(int $id)
    {
        return $this->repository->find($id);
    }

    public function save($data)
    {
        return $this->repository->save($data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
