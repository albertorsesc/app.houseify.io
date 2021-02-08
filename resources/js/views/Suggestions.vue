<script>
export default {
    name: "Suggestions",
    data() {
        return {
            suggestion: {
                subject: '',
                body: '',
            }
        }
    },
    methods: {
        submit () {
            axios.post('/api/suggestions', this.suggestion)
            .then(() => {

            })
            .catch(error => { dd(error) })
        }
    }
}
</script>

<style scoped>

</style>
