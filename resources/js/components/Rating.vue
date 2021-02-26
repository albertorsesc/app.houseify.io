<template>

    <div>
        <star-rating v-model="rating"
                     :star-size="size"
                     :rounded-corners="true"
                     :animate="isAnimated"
                     :border-width="width"
                     :active-on-click="true"
                     :active-color="['#FCD34D']"
                     border-color="#E5E7EB"
                     :active-border-color="['#FCD34D']"
                     :clearable="true"
                     :padding="3"
                     :text-class="'hidden'"
                     @rating-selected="rate"
        ></star-rating>
    </div>

</template>

<script>
import StarRating from 'vue-star-rating'

export default {
    name: "Rating",
    props: {
        endpoint: {
            type: String,
            required: true,
        },
        rating: {
            default: 2
        },
        size: {
            type: Number,
            default: 25,
        },
        width: {
            type: Number,
            default: 4,
        },
        isAnimated: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {

        }
    },
    methods: {
        rate() {
            axios.put()
        }
    },
    components: {
        StarRating,
    }
}
</script>

<style scoped>

</style>
