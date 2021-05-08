const tenantAjax = (new function () {
    const self = this;

    self.get = (url) => {
        $.ajax({
            url,
            type: 'GET',
        }).then(function (res) {
            return res;
        }).catch(function (error) {
            toastrMessage(error.responseJSON.message, false);
        });
    }

    self.post = (url, data = {}) => {
        $.ajax({
            url,
            type: 'POST',
            data
        }).then(function (data) {
            tenantRedirect.refirectBackRouteWithMesssage(data.message);
        }).catch(function (error) {
            toastrMessage(error.responseJSON.message, false);
        });
    }

    self.put = (url, data = {}) => {
        $.ajax({
            url,
            type: 'PUT',
            data
        }).then(function (data) {
            tenantRedirect.refirectBackRouteWithMesssage(data.message)
        }).catch(function (error) {
            toastrMessage(error.responseJSON.message, false);
        });
    }

    self.delete = (url) => {
        $.ajax({
            url,
            type: 'DELETE',
        }).then(function (data) {
            toastrMessage(data.message);
            setTimeout(function () {
                document.location.reload();
            }, 2000)
        }).catch(function (error) {
            toastrMessage(error.responseJSON.message, false);
        })
    }

})
