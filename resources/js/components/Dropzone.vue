<template>
    <vue-drop-zone ref="myVueDropzone"
                   id="dropzone"
                   :options="dropzoneOptions"
                   :duplicate-check="true"
                   :use-custom-slot="true"
                   @vdropzone-success-multiple="onUploadSuccess"
                   @vdropzone-error="onUploadError">
        <div class="dropzone-custom-content">
            <h3 class="dropzone-custom-title">Arrastre sus imágenes aqui!</h3>
            <div class="subtitle">...o seleccione una imágen desde su computadora.</div>
        </div>
    </vue-drop-zone>
</template>

<script>
import VueDropZone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import SweetAlert from "../models/SweetAlert";

export default {
    name: "Dropzone",
    props: {
        endpoint: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            dropzoneOptions: {
                url: this.endpoint,
                uploadMultiple: true,
                maxFiles: 15,
                dictMaxFilesExceeded: 'Max. de img alcanzadas!',
                acceptedFiles: 'image/jpeg,image/png',
                paramName: 'images',
                ignoreHiddenFiles: true,
                maxThumbnailFilesize: 4.0,
                dictFileTooBig: 'El archivo es demasiado grande. (4MB)',
                dictInvalidFileType: 'El archivo es invalido. (jpeg, png)',
                dictResponseError: 'Algo ocurrio, refresque la pag. o intente mas tarde.',
                thumbnailWidth: 150,
                thumbnailHeight: 150,
                maxFilesize: 4.5,
                // addRemoveLinks: true,
                // dictRemoveFile: 'Eliminar',
                dictCancelUpload: 'Cancelar',
                dictCancelUploadConfirmation: 'Cancelar',
                headers: { "X-CSRF-TOKEN": window.axios.defaults.headers.common['X-CSRF-TOKEN'] }
            },
        }
    },
    methods: {
        onUploadSuccess(file, response) {
            window.Event.$emit('dropzone.success', response)
            let wasSuccessful = false
            /*if (file.upload.progress === 100) {
                wasSuccessful = true
            }
            if (wasSuccessful) {
                window.Event.$emit('dropzone.success', response)
            }*/
        },
        onUploadError(some, errorMessage, xMLHttpRequestError) {
            this.dropzoneOptions.dictResponseError = errorMessage.errors['images.0'][0]
            if (xMLHttpRequestError.status) {
                document.querySelector('[data-dz-errormessage]').innerHTML = this.dropzoneOptions.dictResponseError
            }
        },
    },
    mounted() {
        window.Event.$on('vdropzone-success-multiple', (file, response) => {

        })
    },
    components: {
        VueDropZone,
    }
}
</script>

<style scoped>

</style>
