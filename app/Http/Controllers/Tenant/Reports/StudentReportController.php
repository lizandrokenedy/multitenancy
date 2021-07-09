<?php

namespace App\Http\Controllers\Tenant\Reports;

use App\Helpers\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\AssessmentRepository;
use App\Services\SchoolService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentReportController extends Controller
{
    private $title = 'Relatório Aluno';
    private $path = 'reports';

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

        $schools = (new SchoolService())->listSchoolsAccordingToRole();
        $isStudent = $this->userIsStudent();

        return view("tenants.{$this->path}.students", [
            'items' => $items,
            'title' => $this->title,
            'path' => $this->path,
            'schools' => $schools,
            'isStudent' => $isStudent
        ]);
    }

    private function userIsStudent()
    {
        $userRole = Auth::user()->roles->first();

        if (isset($userRole->id) && $userRole->id == RoleEnum::ALUNO) {
            return true;
        }

        return false;
    }


    public function getData(int $id)
    {
        try {
            $chart = (new AssessmentRepository())->getDataChartStudent($id);
            $info = (new AssessmentRepository())->getLastAssessmentStudent($id);

            if ($this->userIsStudent()) {
                $chart = (new AssessmentRepository())->getDataChartStudent(Auth::id());
                $info = (new AssessmentRepository())->getLastAssessmentStudent(Auth::id());
            }

            $data = [
                'chart' => $chart,
                'info' => $info
            ];

            return $this->responseDataSuccess($data);
        } catch (Exception $e) {
            return $this->responseError();
        }
    }


    public function getHistoryStudent($id)
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

            return $this->responseDataSuccess($data);
        } catch (Exception $e) {
            return $this->responseError();
        }
    }
}
