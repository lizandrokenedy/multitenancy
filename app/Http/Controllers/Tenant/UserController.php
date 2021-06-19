<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\State;
use App\Services\RoleService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->checkPermission('tela-usuarios-administrativo-visualizar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => 'Usuários', 'url' => ''],
            ];

            $canCreate = Gate::check('tela-usuarios-administrativo-criar');
            $canEdit = Gate::check('tela-usuarios-administrativo-editar');
            $canRemove = Gate::check('tela-usuarios-administrativo-excluir');
            return view('tenants.users.index', compact('items', 'canEdit', 'canRemove', 'canCreate'));
        } catch (Exception $e) {
            if ($e->getCode() === 403) {
                return redirect()->route('access-denied');
            }
            return $this->responseError($e->getMessage());
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

            $this->checkPermission('tela-usuarios-administrativo-criar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => 'Usuários', 'url' => route('tenants.users.index')],
                (object)['title' => 'Criar Usuário', 'url' => '']
            ];

            $roles = (new RoleService())->listRoleAccordingToPermission();
            $states = State::all();

            return view('tenants.users.create', compact('items', 'roles', 'states'));
        } catch (Exception $e) {
            if ($e->getCode() === 403) {
                return redirect()->route('access-denied');
            }
            return $this->responseError($e->getMessage());
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
            $this->checkPermission('tela-usuarios-administrativo-criar');

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
            $this->checkPermission('tela-usuarios-administrativo-visualizar');

            return DataTables::of($this->service->listUserAccordingToPermission())->toJson();
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
            $this->checkPermission('tela-usuarios-administrativo-editar');
            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => 'Usuários', 'url' => route('tenants.users.index')],
                (object)['title' => 'Editar Usuário', 'url' => '']
            ];

            $user = $this->service->findById($id);

            $roles = (new RoleService())->listRoleAccordingToPermission();
            $states = State::all();

            return view('tenants.users.update', compact('user', 'items', 'roles', 'states'));
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
            $this->checkPermission('tela-usuarios-administrativo-editar');

            $validate = $this->validateRequest($request);

            if ($validate->fails()) {
                return $this->responseError($validate->errors());
            }

            $this->service->update($request->all(), $id);

            return $this->responseSuccess();
        } catch (Exception $e) {
            if ($e->getCode() === 403) {
                return redirect()->route('access-denied');
            }
            return $this->responseError($e->getMessage());
        }
    }

    private function validateRequest($request)
    {
        return Validator::make(
            $request->all(),
            (new UserRequest())->rules($request),
            (new UserRequest())->messages()
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
            $this->checkPermission('tela-usuarios-administrativo-excluir');

            $this->service->delete($id);

            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }


    public function profile()
    {
        return view('tenants.users.profile');
    }
}
