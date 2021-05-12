$.extend(true, $.fn.dataTable.defaults, {
    language: { url: '../datatable-pt-br.json' },
    serverSide: true,
    processing: true,
    searching: true,
    responsive: true,
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ajaxStart(function () { Pace.restart(); });


