<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Services\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyController extends Controller
{

    private $service;

    public function __construct()
    {
        $this->service = new CompanyService();
    }

    public function index()
    {
        return view('tenants.companies.index');
    }

    public function store(Request $request)
    {

        // dd($request->all());

        // $company = Company::create([
        //     'name' => 'Magazine Luiza',
        //     // 'domain' => Str::random(5) . 'empresax.com',
        //     'domain' => 'magazine2-tenancy.local',
        //     'bd_database' => 'magazine2_tenant',
        //     // 'bd_database' => 'teste_banco_externo',
        //     'bd_hostname' => env('DB_HOST'),
        //     'bd_username' => env('DB_USERNAME'),
        //     'bd_password' => env('DB_PASSWORD'),
        // ]);


        // if ($rodaApenasMigrationsDatabaseExterno = false) {
        //     event(new DatabaseCreated($company));
        // } else {
        //     event(new CompanyCreated($company));
        // }

        // dd($company);

        try {
            DB::transaction(function () use ($request) {

                $company = $this->service->save($request->all());
                event(new CompanyCreated($company));

            });

            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }

    public function companiesList(Request $request)
    {
        try {
            return $this->responseDataSuccess($this->service->listar());
        } catch (Exception $e) {
            return $this->responseError();
        }
    }

    public function create()
    {
        return view('tenants.companies.create');
    }

    public function show($id)
    {
        $company = $this->service->findById($id);
        return view('tenants.companies.show', compact('company'));
    }

    public function destroy($id)
    {
        return $this->responseSuccess();
    }
}
