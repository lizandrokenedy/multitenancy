@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h5>{{ $title }}</h5>
            <x-breadcrumb :items="$items" />
        </div>
    </div>
@stop

@section('content')
    <div class="card card-secondary">
        <div class="card-body">
            @if ($isStudent)
                <input type="hidden" id="student" value="{{ Auth::id() }}">
            @else

                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="school" class="required">Escola</label>
                        <select class="form-control" name="school" id="school">
                            <option value="">Selecione</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="student" class="required">Aluno</label>
                        <select class="form-control" name="student" id="student">
                            <option value="">Selecione</option>
                        </select>
                    </div>
                </div>

            @endif

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <canvas id="chart"></canvas>
                </div>

                <div class="col-sm-12 col-md-6">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h5 class="text-center profile-username">Informações Complementares</h5>
                            <div id="info-assessment">



                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset("js/tenants/{$path}/students.js") }}"></script>
    <script>
        report.init();

    </script>
@stop
