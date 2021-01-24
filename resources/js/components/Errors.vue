<template>
    <div v-if="error">
        <div v-if="options.bordered" class="flex justify-start items-center rounded-md text-sm text-red-700 p-2" role="alert">
            <!--<svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>-->
            <p class="" v-text="error[0]"></p>
        </div>

        <div v-if="options.alert"
             :class="['alert alert-danger']"
             v-text="error[0]"
        ></div>

        <div v-if="options.noContainer"
             v-text="error[0]"
             class="text-sm text-red-700"
        ></div>
    </div>
</template>

<script>
export default {
    name: 'Errors',
    props: {
        error: {
            required: true
        },
        options: {
            type: Object,
            required: true
        },
    }
}
</script>
