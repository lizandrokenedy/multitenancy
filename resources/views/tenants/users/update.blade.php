@extends('adminlte::page')

@section('title', 'Usuário')

@section('content_header')
    <h1>Atualizar Usuário</h1>
@stop

@section('content')
    <div class="card card-secondary">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form name="form" id="form">
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}" />
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
