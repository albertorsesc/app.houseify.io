module.exports = {
    methods: {
        canUpdateReply(reply) {
            return reply.author.id === this.auth
        }
    }
}
