<script>

import Modal from "./Modal";
import Errors from "./Errors";
import VueMultiselect from "vue-multiselect";
import SweetAlert from "../models/SweetAlert";

export default {
    props: {
        modelId: {
            type: String,
            required: true,
        },
        modelName: { // Plural
            type: String,
            required: true
        }
    },
    data() {
        return {
            report: {
                reportingCause: '',
                comments: '',
            },

            errors: [],
            modalId: 'reports',
        }
    },
    methods: {
        submitReport() {
            axios.post(`/${this.modelName}/${this.modelId}/report`, {
                'reporting_cause': this.report.reportingCause,
                'comments': this.report.comments,
            }).then(() => {
                this.closeModal()
                SweetAlert.success(`El Reporte ha sido enviado exitosamente, agradecemos tu apoyo!`)
            }).catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        openModal() {
            this.errors = []
            this.modalId = 'reports'

            window.Event.$emit(`${this.modalId}:open`)
        },
        closeModal() {
            this.errors = []
            this.report = {}

            window.Event.$emit(`${this.modalId}:close`)
            this.modalId = ''
        },
    },
    components: {
        Modal,
        Errors,
        VueMultiselect,
    },
}
</script>
