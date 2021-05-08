$.extend(true, $.fn.dataTable.defaults, {
    language: { url: '../datatable-pt-br.json' },
    serverSide: true,
    processing: true,
    searching: false,
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ajaxStart(function () { Pace.restart(); });


// const dataTableAjax = function (url) {

// }

// const redirectBackRoute = function () {
//     setTimeout(function () {
//         history.go(-1);
//     }, 2000)
// }

// const refirectBackRouteWithMesssage = function (message, success = true) {
//     toastrMessage(message, success)
//     redirectBackRoute()
// }

// const toastrMessage = function (message, success = true) {
//     success === true ? toastr.success(message) : toastr.error(message);
// }

// const getAjax = function (url) {
//     $.ajax({
//         url,
//         type: 'GET',
//     }).then(function (res) {
//         return res;
//     }).catch(function (error) {
//         toastrMessage(error.responseJSON.message, false);
//     });
// }

// const postAjax = function (url, data = {}) {
//     $.ajax({
//         url,
//         type: 'POST',
//         data
//     }).then(function (data) {
//         refirectBackRouteWithMesssage(data.message);
//     }).catch(function (error) {
//         toastrMessage(error.responseJSON.message, false);
//     });
// }

// const putAjax = function (url, data = {}) {
//     $.ajax({
//         url,
//         type: 'PUT',
//         data
//     }).then(function (data) {
//         refirectBackRouteWithMesssage(data.message)
//     }).catch(function (error) {
//         toastrMessage(error.responseJSON.message, false);
//     });
// }

// const deleteAjax = function (url) {
//     $.ajax({
//         url,
//         type: 'DELETE',
//     }).then(function (data) {
//         toastrMessage(data.message);
//     }).catch(function (error) {
//         toastrMessage(error.responseJSON.message, false);
//     })
// }
