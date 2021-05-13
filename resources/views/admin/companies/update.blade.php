@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h5>Editar Empresa</h5>
            <x-breadcrumb :items="$items" />
        </div>
    </div>
@stop

@section('content')
    <div class="card card-secondary">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form name="form" id="form">
                        <input type="hidden" name="id" id="id" value="{{ $company->id }}" />
                        @include('admin.companies._partials.form')
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer">
    The footer of the card
</div> --}}
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/admin/companies/manter.js') }}"></script>
    <script>
        manter.init();

    </script>
@stop
