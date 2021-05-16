module.exports = {
    methods: {
        canUpdateThread(thread) {
            return thread.author.id === this.auth
        }
    }
}
