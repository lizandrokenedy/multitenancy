<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new RoleService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = [
            (object)['title' => 'Home', 'url' => route('home'),],
            (object)['title' => 'Perfis', 'url' => ''],
        ];

        return view('tenants.roles.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = [
            (object)['title' => 'Home', 'url' => route('home'),],
            (object)['title' => 'Perfis', 'url' => route('tenants.roles.index')],
            (object)['title' => 'Criar Perfil', 'url' => '']
        ];
        return view('tenants.roles.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            return DataTables::of($this->service->listAll())->toJson();
        } catch (Exception $e) {
            return $this->responseError();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = [
            (object)['title' => 'Home', 'url' => route('home'),],
            (object)['title' => 'Perfis', 'url' => route('tenants.roles.index')],
            (object)['title' => 'Editar Perfil', 'url' => '']
        ];

        $user = $this->service->findById($id);
        return view('tenants.roles.update', compact('user', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            (new RoleRequest())->rules($request),
            (new RoleRequest())->messages()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->responseSuccess();
    }
}
