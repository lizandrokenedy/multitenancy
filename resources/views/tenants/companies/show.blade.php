@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card card-secondary">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('companies.update') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        @include('tenants.companies._partials.form')
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
    <script>
        console.log('Hi!');

    </script>
@stop
