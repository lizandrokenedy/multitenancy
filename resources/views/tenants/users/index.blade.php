@extends('adminlte::page')

@section('title', 'Usuário')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h1>Usuários</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i>
                Novo
            </a>
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
    <script src="{{ asset('js/tenant/users/index.js') }}"></script>
    <script>
        index.init();

    </script>
@stop
