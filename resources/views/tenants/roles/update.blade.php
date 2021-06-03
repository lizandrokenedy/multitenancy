@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h5>Editar Perfil</h5>
            <x-breadcrumb :items="$items" />
        </div>
    </div>
@stop

@section('content')
    <div class="card card-secondary">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form name="form" id="form">
                        <input type="hidden" name="id" id="id" value="{{ $role->id }}" />
                        @include('tenants.roles._partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/tenants/roles/manter.js') }}"></script>
    <script>
        manter.init();

    </script>
@stop
