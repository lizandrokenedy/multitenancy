const tenantAjax = (new function () {
    const self = this;
    self.buttons = $('.btn');

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
        return $.ajax({
            url,
            type: 'POST',
            data
        }).then(function (data) {
            // self.buttons.attr('disabled', 'disabled');
            // tenantRedirect.refirectBackRouteWithMesssage(data.message);
            return true;
        }).catch(function (error) {
            self.buttons.removeAttr('disabled');
            tenantMessage.messageErrorAjax(error)
            return false;
        });
    }

    self.put = (url, data = {}) => {
        return $.ajax({
            url,
            type: 'PUT',
            data
        }).then(function (data) {
            self.buttons.attr('disabled', 'disabled');
            tenantRedirect.refirectBackRouteWithMesssage(data.message)
            return true;
        }).catch(function (error) {
            self.buttons.removeAttr('disabled');
            tenantMessage.messageErrorAjax(error)
            return false;
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
