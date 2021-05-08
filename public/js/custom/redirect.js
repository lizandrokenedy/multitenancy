import { toastrMessage } from './messages.js';

export function redirectBackRoute() {
    setTimeout(function () {
        history.go(-1);
    }, 2000)
}

export function refirectBackRouteWithMesssage(message, success = true) {
    toastrMessage(message, success)
    redirectBackRoute()
}
