<template>
    <div :class="['form-group', error ? errorClasses : '']">
        <label v-if="title" :for="inputId">
            <strong class="required" v-if="isRequired">*</strong>
            {{ title }}
        </label>
        <div class="rounded-md shadow-sm mb-1">
            <input :type="type"
                   :value="data"
                   @input="update($event.target.value)"
                   :id="inputId"
                   :class="['h-input block w-full ', error ? errorClasses : '']"
                   :autofocus="isFocused"
                   :placeholder="placeholder">
        </div>
        <!--Errors-->
        <errors :error="error" :options="{ noContainer: true }"></errors>
    </div>
</template>

<script>
    import Errors from './Errors'

    export default {
        name: 'FormInput',
        props: {
            data: {
                required: true,
            },
            title: {
                required: false,
                type: String
            },
            isRequired: {
                required: false,
                default: false
            },
            error: {
                required: false,
                type: Array
            },
            inputId: {
                required: true,
                type: String
            },
            type: {
                required: false,
                default: 'text'
            },
            isFocused: {
                required: false,
                default: false
            },
            placeholder: {
                required: false,
                type: String
            }
        },
        data() {
            return {
                inputData: '',
            }
        },
        methods: {
            update(value) {
                this.$emit('input', value)
            }
        },
        computed: {
            errorClasses() {
                return 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red';
            }
        },
        components: {
            Errors
        }
    }
</script>
