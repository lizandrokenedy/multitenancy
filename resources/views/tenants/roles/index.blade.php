@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            @if ($canCreate)
                <x-btn-new route="tenants.roles.create" />
            @endif
            <x-breadcrumb :items="$items" />
        </div>
    </div>
@stop

@section('content')
    <div class="card card-secondary">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/tenants/roles/index.js') }}"></script>
    <script>
        index.init();
        index.canEdit = "{{ $canEdit }}"
        index.canRemove = "{{ $canRemove }}"

    </script>
@stop
