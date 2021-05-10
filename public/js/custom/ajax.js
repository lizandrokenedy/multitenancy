const tenantAjax = (new function () {
    const self = this;

    self.get = (url) => {
        $.ajax({
            url,
            type: 'GET',
        }).then(function (res) {
            return res;
        }).catch(function (error) {
            tenantMessage.messageErrorAjax(error)
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
            tenantMessage.messageErrorAjax(error)
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
            tenantMessage.messageErrorAjax(error)
        });
    }

    self.delete = async (url) => {
        await $.ajax({
            url,
            type: 'DELETE',
        }).then(function (data) {
            tenantMessage.toastrMessage(data.message);
        }).catch(function (error) {
            tenantMessage.messageErrorAjax(error)
        })
    }


})
