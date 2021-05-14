<script>
import { mapGetters } from 'vuex'
import VueMultiselect from 'vue-multiselect'

export default {
    name: "Threads",
    data() {
        return {
            threads: [],
            endpoint: 'threads',
            threadForm: {},
            threadsTab: 'show-threads',

            errors: [],
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint)
            .then(response => {
                this.threads = response.data.data
            })
            .catch(error => dd(error))
        },
        store() {
            axios.post(this.endpoint, {
                title: this.threadForm.title,
                body: this.threadForm.body,
                category: this.threadForm.category,
            })
            .then(response => {
                this.threadsTab = 'show-threads'
                this.threads.unshift(response.data.data)
            })
            .catch(error => this.errors = error.response.status === 422 ?
                error.response.data.errors :
                [])
        },
    },
    computed: {
        ...mapGetters({
            getConstructionCategories: 'general/getConstructionCategories'
        })
    },
    created() {
        this.index()

        this.$store.dispatch('general/fetchConstructionCategories')
    },
    components: {
        VueMultiselect,
        Errors: () => import(/* webpackChunkName: "errors" */ '../../../components/Errors'),
    }
}
</script>

<style scoped>

</style>
