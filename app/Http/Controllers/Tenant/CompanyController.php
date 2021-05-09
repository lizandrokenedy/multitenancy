<?php

namespace App\Http\Controllers\Tenant;


use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

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

            $validate = Validator::make($request->all(), (new CompanyRequest())->rules());

            if ($validate->fails()) {
                return $this->responseError($validate->errors());
            }

            $this->service->save($request->all());

            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }

    public function companiesList(Request $request)
    {
        try {
            return DataTables::of($this->service->listAll())
                ->addIndexColumn()
                ->toJson();
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
        try {

            $validate = Validator::make($request->all(), (new CompanyRequest())->rules());

            if ($validate->fails()) {
                return $this->responseError($validate->errors());
            }

            $this->service->update($request->all(), $id);

            return $this->responseSuccess();
        } catch (Exception $e) {
            $this->responseError($e->getMessage());
        }
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
