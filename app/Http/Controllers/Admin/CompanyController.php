<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
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
        $items = [
            (object)['title' => 'Home', 'url' => route('home'),],
            (object)['title' => 'Empresas', 'url' => ''],
        ];

        return view('admin.companies.index', compact('items'));
    }

    public function store(Request $request)
    {

        try {

            $validate = $this->validateRequest($request);

            if ($validate->fails()) {
                return $this->responseError($validate->errors());
            }

            $this->service->create($request->all());

            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * List all
     *
     * @param Request $request
     * @return void
     */
    public function listAll(Request $request)
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
        $items = [
            (object)['title' => 'Home', 'url' => route('home'),],
            (object)['title' => 'Empresas', 'url' => route('admin.companies.index')],
            (object)['title' => 'Criar Empresa', 'url' => '']
        ];

        return view('admin.companies.create', compact('items'));
    }

    public function edit($id)
    {
        $items = [
            (object)['title' => 'Home', 'url' => route('home'),],
            (object)['title' => 'Empresas', 'url' => route('admin.companies.index')],
            (object)['title' => 'Editar Empresa', 'url' => '']
        ];

        $company = $this->service->findById($id);

        return view('admin.companies.update', compact('company', 'items'));
    }

    public function update(Request $request, $id)
    {
        try {

            $validate = $this->validateRequest($request);

            if ($validate->fails()) {
                return $this->responseError($validate->errors());
            }

            $this->service->update($request->all(), $id);

            return $this->responseSuccess();
        } catch (Exception $e) {
            $this->responseError($e->getMessage());
        }
    }


    private function validateRequest($request)
    {
        return Validator::make(
            $request->all(),
            (new CompanyRequest())->rules($request),
            (new CompanyRequest())->messages()
        );
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->responseSuccess();
    }
}
