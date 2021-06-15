<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $title = 'Relatórios';
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

        return view("tenants.{$this->path}.index", [
            'items' => $items,
            'title' => $this->title,
            'path' => $this->path
        ]);
    }
}
