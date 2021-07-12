<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Mail\HistoryStudent;
use App\Models\Period;
use App\Models\Serie;
use App\Repositories\Eloquent\AssessmentRepository;
use App\Services\SchoolService;
use App\Services\StudentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    private $title = 'Estudantes';
    private $path = 'students';

    private $service;

    public function __construct()
    {
        $this->service = new StudentService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->checkPermission('tela-alunos-administrativo-visualizar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => $this->title, 'url' => ''],
            ];

            $canEdit = Gate::check('tela-alunos-administrativo-editar');

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
            $this->checkPermission('tela-alunos-administrativo-visualizar');

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
            $this->checkPermission('tela-alunos-administrativo-editar');

            $items = [
                (object)['title' => 'Home', 'url' => route('home'),],
                (object)['title' => $this->title, 'url' => route("tenants.{$this->path}.index")],
                (object)['title' => "Editar {$this->title}", 'url' => '']
            ];

            $data = $this->service->findById($id);
            // dd($data);
            $schools = (new SchoolService)->listAll()->get();
            $series = Serie::all();
            $periods = Period::all();

            return view("tenants.{$this->path}.update", [
                'items' => $items,
                'title' => $this->title,
                'path' => $this->path,
                'data' => $data,
                'schools' => $schools,
                'series' => $series,
                'periods' => $periods,
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
            $this->checkPermission('tela-alunos-administrativo-editar');

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
            (new StudentRequest())->rules($request),
            (new StudentRequest())->messages()
        );
    }


    public function listStudentSchool($idSchool)
    {
        return $this->responseDataSuccess($this->service->listStudentSchool($idSchool));
    }

    public function sendMailHistory($id)
    {
        try {

            $chart = (new AssessmentRepository())->getDataChartStudent($id);
            $infos = (new AssessmentRepository())->getAllAssessmentStudent($id);

            if ($this->userIsStudent()) {
                $chart = (new AssessmentRepository())->getDataChartStudent(Auth::id());
                $infos = (new AssessmentRepository())->getAllAssessmentStudent(Auth::id());
            }

            $data = [
                'chart' => $chart,
                'infos' => $infos
            ];

            Mail::send((new HistoryStudent($data)));

            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }

    // public function sendMailHistory(Request $request)
    // {
    //     try {

    //         $file = base64_decode($request->file);

    //         // dd(file_get_contents($file));

    //         Storage::put('avaliacao.pdf', $file);

    //         return $this->responseDataSuccess($request->all());
    //     } catch (Exception $e) {
    //         return $this->responseError($e->getMessage());
    //     }
    // }


    private function userIsStudent()
    {
        $userRole = Auth::user()->roles->first();

        if (isset($userRole->id) && $userRole->id == RoleEnum::ALUNO) {
            return true;
        }

        return false;
    }



    public function testeView($id)
    {
        try {

            $chart = (new AssessmentRepository())->getDataChartStudent($id);
            $infos = (new AssessmentRepository())->getAllAssessmentStudent($id);

            if ($this->userIsStudent()) {
                $chart = (new AssessmentRepository())->getDataChartStudent(Auth::id());
                $infos = (new AssessmentRepository())->getAllAssessmentStudent(Auth::id());
            }

            $data = [
                'chart' => $chart,
                'infos' => $infos
            ];

            return view('tenants.students.mail-history', compact('data'));
        } catch (Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }
}
