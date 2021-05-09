<?php

namespace App\Services;

use App\Events\Tenant\CompanyCreated;
use App\Messages\CompanyMessages;
use App\Models\Company;
use App\Repositories\Eloquent\CompanyRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository;
    }

    /**
     * List All
     *
     *
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
    public function findById(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Save registre
     *
     * @param array $data
     * @return Company
     */
    public function save(array $data): Company
    {
        $company = $this->repository->save($data);

        if (!$company) {
            throw new Exception(CompanyMessages::ERRO_AO_CRIAR_EMPRESA);
        }

        event(new CompanyCreated($company));

        return $company;
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
        return $this->repository->update($data, $id);
    }

    /**
     * Delete Registre
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
