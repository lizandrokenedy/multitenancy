@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Criar Empresa</h1>
@stop

@section('content')
    <div class="card card-secondary">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('companies.store') }}" method="post">
                        @include('tenants.companies._partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/tenant/companies/manter.js') }}"></script>
    <script>
        manter.init()

    </script>
@stop
