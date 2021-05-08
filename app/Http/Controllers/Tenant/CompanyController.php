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

    public function edit($id)
    {
        $company = $this->service->findById($id);
        return view('tenants.companies.update', compact('company'));
    }

    public function update(Request $request, $id)
    {
        return $this->responseSuccess();
    }

    public function show($id)
    {
        $company = $this->service->findById($id);
        return view('tenants.companies.show', compact('company'));
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->responseSuccess();
    }
}
