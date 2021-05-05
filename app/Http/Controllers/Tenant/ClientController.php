<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tenants.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function clientsList(Request $request)
    {
        $clients = [
            "draw" => 1,
            "recordsTotal" => 1,
            "recordsFiltered" => 1,
            "data" => [
                [
                    "id" => 1,
                    "nome" => "Magazine",
                    "host" => "magazine-tenancy.local"
                ],
                [
                    "id" => 2,
                    "nome" => "Ponto-frio",
                    "host" => "Ponto-frio-tenancy.local"
                ],
                [
                    "id" => 3,
                    "nome" => "Casas-bahia",
                    "host" => "Casas-bahia-tenancy.local"
                ]

            ]
        ];

        return json_encode($clients, true);
    }
}
