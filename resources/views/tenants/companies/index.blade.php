@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h1>Clientes</h1>
            <a href="{{ route('companies.create') }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i>
                Novo
            </a>
        </div>
    </div>

@stop

@section('content')
    <div class="card card-secondary">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="table" class="table table-striped">

                    </table>
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
    <script src="{{ asset('js/tenant/companies/index.js') }}"></script>
    <script>
        index.init();

    </script>
@stop
