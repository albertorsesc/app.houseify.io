// const Swal = require('sweetalert2')
import Swal from 'sweetalert2'

class SweetAlert {

    static success(title) {
        Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: title,
            showConfirmButton: false,
            timer: 1500
        })
    }

    static danger(title, onConfirmedText) {
        Swal.fire({
            title: title,
            text: 'Esta accion no se puede deshacer!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then(result => {
            if (result.value) {
                Event.$emit('SweetAlert:destroy')

                Swal.fire(
                    'Eliminado!',
                    onConfirmedText,
                    'success',
                )
            }
        })
    }

    static toast(title) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: title
        })
    }

}

export default SweetAlert
