const tenantMessage = (new function () {
    const self = this;
    self.toastrMessage = (message, success = true) => {
        success === true ? toastr.success(message) : toastr.error(message);
    }
})

