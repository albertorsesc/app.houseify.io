<template>
    <!--Likes-->
    <div class="flex justify-between md:w-1/8 space-x-5">
        <!--Like-->
        <span @click="like"
              class="items-center align-middle cursor-pointer">
            <svg class="h-6 w-6 hover:text-emerald-300"
                 :class="[isLiked ? 'text-emerald-300' : 'text-gray-300']"
                 fill="none"
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
            </svg>
            <span class="text-xs text-gray-400 font-light"
                  :class="getLikesCount < 99 ? 'ml-2' : ''"
                  v-text="getLikesCount"></span>
        </span>
        <!--Dislike-->
        <span @click="dislike"
              class="items-center align-middle cursor-pointer">
            <svg class="h-6 w-6 text-gray-300 hover:text-red-400"
                 :class="[! isLiked && isLiked !== null ? 'text-red-400' : 'text-gray-300']"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
            </svg>
            <span class="text-xs text-gray-400 font-light"
                  :class="[getDislikesCount < 99 ? 'ml-2' : 'ml-1']"
                  v-text="getDislikesCount"></span>
        </span>
    </div>
</template>

<script>
export default {
    name: "Likes",
    props: {
        model: {
            required: true,
            type: Object
        },
        endpoint: {
            type: String,
            required: true
        },
        id: {
            required: false,
            type: String,
            default: 'slug',
        },
    },
    data() {
        return {
            modelId: this.id ? this.id : this.model.slug,
            likes: this.model.likes,
            isLiked: null,
            likesCount: 0,
            dislikesCount: 0,
            userId: 0,
        }
    },
    methods: {
        like() {
            axios.post(this.endpoint + '/like')
            .then(response => {
                this.likes = response.data.data.likes
                this.isLiked = response.data.data.isLiked
                this.check()
            })
            .catch(error => dd(error))
        },
        dislike() {
            axios.delete(this.endpoint + '/dislike')
            .then(response => {
                this.likes = response.data.data.likes
                this.isLiked = response.data.data.isLiked
                this.check()
            })
            .catch(error => dd(error))
        },
        check() {
            this.redirectIfGuest()

            if (this.authLike && this.authLike.length > 0) {
                if (this.authLike.filter(like => like.liked == true).length) {
                    this.isLiked = true
                } if (this.authLike.filter(like => like.liked == false).length) {
                    this.isLiked = false
                }
            } else {
                this.isLiked = null
            }
        },
    },
    computed: {
        authLike() {
            return this.likes.filter(
                like => like.liked_by === this.auth
            )
        },
        getLikesCount() {
            return this.likes.filter(
                like => like.liked == true
            ).length
        },
        getDislikesCount() {
            return this.likes.filter(
                like => like.liked == false
            ).length
        },
    },
    created () {
        this.check()
        dd(this.isLiked)
    },
}
</script>

<style scoped>

</style>
