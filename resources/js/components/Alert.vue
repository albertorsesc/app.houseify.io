<template>

    <div :class="[alertStyle.bg, alertStyle.border, 'border-t-4', 'rounded-b', 'text-teal-700', 'px-4', 'py-3', 'shadow-md', 'w-full', 'my-1']" role="alert">
        <div class="flex justify-center align-middle items-center">
            <div class="py-1"><svg :class="[alertStyle.svg, 'fill-current', 'h-6', 'w-6', 'mr-4']" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
                <p class="font-bold">
                    <slot></slot>
                </p>
                <slot name="small"></slot>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'primary'
            }
        },
        data() {
            return {
                alertStyle: {},
                warning: {
                    bg: 'bg-yellow-100',
                    border: 'border-yellow-400',
                    svg: 'text-yellow-600'
                },
                danger: {
                    bg: 'bg-red-100',
                    border: 'border-red-400',
                    svg: 'text-red-600'
                },
                primary: {
                    bg: 'bg-teal-200',
                    border: 'border-teal-400',
                    svg: 'text-teal-600'
                },

                info: {
                    bg: 'bg-blue-100',
                    border: 'border-blue-400',
                    svg: 'text-blue-500',
                }
            }
        },
        methods: {
            getAlertType() {
                if (this.type === 'warning') {
                    this.alertStyle = this.warning
                }
                if (this.type === 'primary') {
                    this.alertStyle = this.primary
                }
                if (this.type === 'info') {
                    this.alertStyle = this.info
                }
            }
        },
        mounted() {
            this.getAlertType()
        }
    }
</script>
