<?php

namespace App\Services;

use App\Events\Tenant\CompanyCreated;
use App\Messages\CompanyMessages;
use App\Models\Company;
use App\Repositories\DB\InformationSchemaRepository;
use App\Repositories\Eloquent\CompanyRepository;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;


class CompanyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository;
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
    public function create(array $data): Company
    {
        $formattedData = $this->formatDataForCreateCompany($data);

        if ($this->validateDatabaseExists($formattedData['bd_database'])) {
            throw new Exception(CompanyMessages::ERRO_EXISTE_UMA_BASE_DADOS_COM_ESTE_NOME);
        }

        $company = $this->repository->save($formattedData);

        if (!$company) {
            throw new Exception(CompanyMessages::ERRO_AO_CRIAR_EMPRESA);
        }

        event(new CompanyCreated($company));

        return $company;
    }

    private function formatDataForCreateCompany(array $data): array
    {
        $database = [];

        $database['bd_database'] = $this->createNameDataBase($data['name']);
        $database['bd_hostname'] = env('DB_HOST');
        $database['bd_username'] = env('DB_USERNAME');
        $database['bd_password'] = Crypt::encrypt(env('DB_PASSWORD'));

        return array_merge($data, $database);
    }

    private function validateDatabaseExists($database)
    {
        return (new InformationSchemaRepository())->databaseQueryByBame($database) > 0 ?
            true : false;
    }

    private function createNameDataBase(string $companyName): string
    {
        return  explode(' ', strtolower($companyName))[0] . "_" . strtolower(Str::random(3)) . '_tenant';
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

        if (!$registry) {
            throw new Exception(CompanyMessages::REGISTRO_NAO_ENCONTRADO);
        }

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

        $registry = $this->findById($id);

        if (!$registry) {
            throw new Exception(CompanyMessages::REGISTRO_NAO_ENCONTRADO);
        }

        return $this->repository->delete($id);
    }
}
