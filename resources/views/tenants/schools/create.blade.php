@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h5>Criar {{ $title }}</h5>
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
                        @include("tenants.{$path}._partials.form")
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset("js/tenants/{$path}/manter.js") }}"></script>
    <script>
        manter.path = "{{$path}}"
        manter.init();

    </script>
@stop
