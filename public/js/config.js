$.extend(true, $.fn.dataTable.defaults, {
    language: { url: '../datatable-pt-br.json' },
    serverSide: true,
    processing: false,
    searching: false,
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ajaxStart(function () { Pace.restart(); });


