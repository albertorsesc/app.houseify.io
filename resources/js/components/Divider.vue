<template>
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-2 bg-white text-sm text-gray-500"
                  v-text="title"
            ></span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Divider",
    props: {
        title: {
            required: true,
            type: String
        }
    }
}
</script>

<style scoped>

</style>
