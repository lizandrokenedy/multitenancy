const tenantMessage = (new function () {
    const self = this;
    self.toastrMessage = (message, success = true) => {
        success === true ? toastr.success(message) : toastr.error(message);
    }

    self.messageErrorAjax = function (error) {
        const errorMessage = error.responseJSON.message;
        if (typeof errorMessage === 'object' && errorMessage !== null) {
            $.each(errorMessage, (index, value) => self.toastrMessage(value, false))
            return;
        }
       self.toastrMessage(error.responseJSON.message, false);
    }
})



