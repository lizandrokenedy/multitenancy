<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Services\SchoolService;
use App\Services\TeacherService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    private $title = 'Professores';
    private $path = 'teachers';

    private $service;

    public function __construct()
    {
        $this->service = new TeacherService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->checkPermission('tela-professores-administrativo-visualizar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => $this->title, 'url' => ''],
            ];

            $canEdit = Gate::check('tela-professores-administrativo-editar');

            return view("tenants.{$this->path}.index", [
                'items' => $items,
                'title' => $this->title,
                'path' => $this->path,
                'canEdit' => $canEdit,
            ]);
        } catch (Exception $e) {
            if ($e->getCode() === 403) {
                return redirect()->route('access-denied');
            }
            return $this->responseError();
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
            $this->checkPermission('tela-professores-administrativo-visualizar');

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
            $this->checkPermission('tela-professores-administrativo-editar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => $this->title, 'url' => route("tenants.{$this->path}.index")],
                (object)['title' => "Editar {$this->title}", 'url' => '']
            ];

            $data = $this->service->findById($id);

            $schools = (new SchoolService)->listAll()->get();

            return view("tenants.{$this->path}.update", [
                'items' => $items,
                'title' => $this->title,
                'path' => $this->path,
                'data' => $data,
                'schools' => $schools
            ]);
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
            $this->checkPermission('tela-professores-administrativo-editar');

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
            (new TeacherRequest())->rules($request),
            (new TeacherRequest())->messages()
        );
    }
}
