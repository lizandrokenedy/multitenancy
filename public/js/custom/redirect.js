const tenantRedirect = (new function () {
    const self = this;

    self.redirectBackRoute = () => {
        setTimeout(function () {
            history.go(-1);
        }, 2000)
    }

    self.refirectBackRouteWithMesssage = (message, success = true) => {
        tenantMessage.toastrMessage(message, success)
        self.redirectBackRoute()
    }
})


