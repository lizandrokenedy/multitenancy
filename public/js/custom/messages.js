export function toastrMessage(message, success = true) {
    success === true ? toastr.success(message) : toastr.error(message);
}
