<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\Models\State;
use App\Repositories\Eloquent\UserRepository;
use App\Services\SchoolService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SchoolController extends Controller
{
    private $title = 'Escolas';
    private $path = 'schools';


    public function __construct()
    {
        $this->service = new SchoolService();
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
            (object)['title' => $this->title, 'url' => ''],
        ];

        return view("tenants.{$this->path}.index", [
            'items' => $items,
            'title' => $this->title,
            'path' => $this->path
        ]);
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
            (object)['title' => $this->title, 'url' => route("tenants.{$this->path}.index")],
            (object)['title' => "Criar {$this->title}", 'url' => '']
        ];

        $states = State::all();

        $managers = (new UserService)->getAllManagers();

        return view("tenants.{$this->path}.create", [
            'items' => $items,
            'title' => $this->title,
            'path' => $this->path,
            'states' => $states,
            'managers' => $managers
        ]);
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
     * List all
     *
     * @param Request $request
     * @return void
     */
    public function listManagers(Request $request)
    {
        try {
            return DataTables::of((new UserRepository())->getSchoolManagersById($request->school_id))->toJson();
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
            (object)['title' => $this->title, 'url' => route("tenants.{$this->path}.index")],
            (object)['title' => "Editar {$this->title}", 'url' => '']
        ];

        $data = $this->service->findById($id);

        $states = State::all();

        $managers = (new UserService)->getAllManagers();

        return view("tenants.{$this->path}.update", [
            'items' => $items,
            'title' => $this->title,
            'path' => $this->path,
            'data' => $data,
            'states' => $states,
            'managers' => $managers
        ]);
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
            (new SchoolRequest())->rules($request),
            (new SchoolRequest())->messages()
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
