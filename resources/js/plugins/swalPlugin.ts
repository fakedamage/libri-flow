import Swal from "sweetalert2";

export default {
    success(
        title = "Success!",
        text = "Operation completed successfully.",
        callback: Function = () => {}
    ) {
        Swal.fire({
            title,
            text,
            icon: "success",
            confirmButtonText: "OK",
        }).then(() => {
            if (callback) callback();
        });
    },
    error(
        title = "Error!",
        text = "Something went wrong.",
        callback: Function = () => {}
    ) {
        Swal.fire({
            title,
            text,
            icon: "error",
            confirmButtonText: "OK",
        }).then(() => {
            if (callback) callback();
        });
    },
    warning(
        title = "Warning!",
        text = "Be careful!",
        callback: Function = () => {}
    ) {
        Swal.fire({
            title,
            text,
            icon: "warning",
            confirmButtonText: "OK",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) if (callback) callback();
        });
    },
};
