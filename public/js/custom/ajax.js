const getAjax = (url) => {
    $.ajax({
        url,
        type: 'GET',
    }).then(function (res) {
        return res;
    }).catch(function (error) {
        toastrMessage(error.responseJSON.message, false);
    });
}

const postAjax = (url, data = {}) => {
    $.ajax({
        url,
        type: 'POST',
        data
    }).then(function (data) {
        refirectBackRouteWithMesssage(data.message);
    }).catch(function (error) {
        toastrMessage(error.responseJSON.message, false);
    });
}

const putAjax = (url, data = {}) => {
    $.ajax({
        url,
        type: 'PUT',
        data
    }).then(function (data) {
        refirectBackRouteWithMesssage(data.message)
    }).catch(function (error) {
        toastrMessage(error.responseJSON.message, false);
    });
}

const deleteAjax = (url) => {
    $.ajax({
        url,
        type: 'DELETE',
    }).then(function (data) {
        toastrMessage(data.message);
    }).catch(function (error) {
        toastrMessage(error.responseJSON.message, false);
    })
}
