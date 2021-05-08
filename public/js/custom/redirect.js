const redirectBackRoute = () => {
    setTimeout(function () {
        history.go(-1);
    }, 2000)
}

const refirectBackRouteWithMesssage = (message, success = true) => {
    toastrMessage(message, success)
    redirectBackRoute()
}
