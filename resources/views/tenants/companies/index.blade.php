@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <x-btn-new route="companies.create" />
            <x-breadcrumb :items="$items" />
        </div>
    </div>

@stop

@section('content')
    <div class="card card-secondary">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="table" class="table table-striped">

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/tenant/companies/index.js') }}"></script>
    <script>
        index.init();

    </script>
@stop
