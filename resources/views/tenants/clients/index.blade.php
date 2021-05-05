@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
    <div class="card card-secondary">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="table">

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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {

            $('#table').DataTable({
                "serverSide": true,
                "processing": true,

                "ajax": {
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "url": "{{ route('clients-list') }}",
                    "type": "POST"
                },
                "searching": false,
                "columns": [{
                        data: "nome",
                        name: "nome",
                        title: "Nome"
                    },
                    {
                        data: "host",
                        name: "host",
                        title: "Host"
                    }
                ],
                "rowCallback": function(row, data, index) {
                    console.log(index, data);
                }

            });
        });

    </script>
@stop
