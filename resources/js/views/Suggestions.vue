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
            axios.post('/suggestions', this.suggestion)
            .then(() => {

            })
            .catch(error => {})
        }
    }
}
</script>

<style scoped>

</style>
