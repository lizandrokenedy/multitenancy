<?php

namespace App\Http\Controllers\Tenant\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\AssessmentRepository;
use App\Services\SchoolService;
use Illuminate\Http\Request;

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

        return view("tenants.{$this->path}.students", [
            'items' => $items,
            'title' => $this->title,
            'path' => $this->path,
            'schools' => $schools,
        ]);
    }


    public function getData()
    {
        return $this->responseDataSuccess((new AssessmentRepository())->getDataReportStudent(5));
    }
}
