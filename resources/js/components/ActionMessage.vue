<template>
    <div class="flex justify-center items-center align-middle">
        <transition name="fade"
                    :duration="1500">
            <div v-if="shown"
                 class="text-base text-emerald-600 pb-4"
                 :class="shown ? 'flex block' : 'hidden'"
                 v-text="message"
            ></div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "ActionMessage",
    props: {
        message: {
            required: true,
            type: String,
        }
    },
    data() {
        return {
            shown: false,
            timeout: null
        }
    },
    mounted() {
        window.Event.$on('copied', () => {
            clearTimeout(this.timeout);
            this.shown = true;

            this.timeout = setTimeout(() => {
                this.shown = false
            }, 2000);
        })
    }
}
</script>

<style scoped>

</style>
