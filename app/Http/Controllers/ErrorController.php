<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error403()
    {
        return view('errors.403-access-denied');
    }

    public function error404()
    {
        return view('errors.403');
    }
}
