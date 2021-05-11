@extends('adminlte::page')

@section('title', 'Usuário')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h5>Criar Usuário</h5>
            <x-breadcrumb :items="$items" />
        </div>
    </div>
@stop

@section('content')
    <div class="card card-secondary">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('users.store') }}" method="post">
                        @include('tenants.users._partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/tenant/users/manter.js') }}"></script>
    <script>
        manter.init();

    </script>
@stop
