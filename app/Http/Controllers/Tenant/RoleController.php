<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\ModuleService;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    private $service;
    private $title = "Perfil";
    private $path = 'roles';

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
        try {
            $this->checkPermission('tela-perfis-administrativo-visualizar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => $this->title, 'url' => ''],
            ];
            $canCreate = Gate::check('tela-perfis-administrativo-criar');
            $canEdit = Gate::check('tela-perfis-administrativo-editar');
            $canRemove = Gate::check('tela-perfis-administrativo-excluir');

            return view("tenants.{$this->path}.index", [
                'items' => $items,
                'title' => $this->title,
                'path' => $this->path,
                'canCreate' => $canCreate,
                'canEdit' => $canEdit,
                'canRemove' => $canRemove,
            ]);
        } catch (Exception $e) {
            if ($e->getCode() === 403) {
                return redirect()->route('access-denied');
            }
            return $this->responseError();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        try {
            $this->checkPermission('tela-perfis-administrativo-criar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => $this->title, 'url' => route("tenants.{$this->path}.index")],
                (object)['title' => "Criar {$this->title}", 'url' => '']
            ];

            $modules = (new ModuleService)->listAll()->get();

            return view("tenants.{$this->path}.create", compact('items', 'modules'));
        } catch (Exception $e) {
            if ($e->getCode() === 403) {
                return redirect()->route('access-denied');
            }
            return $this->responseError();
        }
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

            $this->checkPermission('tela-perfis-administrativo-criar');

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
            $this->checkPermission('tela-perfis-administrativo-visualizar');

            return DataTables::of($this->service->listAll())->toJson();
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
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
        try {
            $this->checkPermission('tela-perfis-administrativo-editar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => $this->title, 'url' => route("tenants.{$this->path}.index")],
                (object)['title' => "Editar {$this->title}", 'url' => '']
            ];

            $role = $this->service->findById($id);

            $modules = (new ModuleService)->listAll()->get();
            return view("tenants.{$this->path}.update", compact('role', 'modules', 'items'));
        } catch (Exception $e) {
            if ($e->getCode() === 403) {
                return redirect()->route('access-denied');
            }
            return $this->responseError();
        }
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
            $this->checkPermission('tela-perfis-administrativo-editar');

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
        try {
            $this->checkPermission('tela-perfis-administrativo-excluir');

            $this->service->delete($id);

            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }
}
