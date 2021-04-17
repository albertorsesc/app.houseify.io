<template>
    <div :id="modalId"
         v-show="showModal"
         @keydown.escape.window="showModal = false"
         class="z-50 fixed top-0 overflow-y-auto inset-0 px-4 pt-6 sm:px-0 sm:flex sm:items-top sm:justify-center"
         style="display: none;"
         tabindex="-1"
         role="dialog">

            <transition name="modal-fade" appear>
                <div v-show="showModal"
                     class="fixed inset-0 transform transition-all"
                     @click="showModal = false">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
            </transition>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <transition name="modal-dialog" appear>
                <div v-if="showModal && viewAs === 'card'"
                     class="bg-white rounded-lg align-bottom overflow-y-auto shadow-xl transform transition-all md:fixed sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                     aria-labelledby="modal"
                     aria-modal="true"
                     role="document"
                     tabindex="-1"
                     :class="maxWidth">
                    <div class="px-6 py-4">
                        <div class="flex text-lg text-teal-400 font-semibold">
                            <slot name="title"></slot>
                        </div>

                        <div class="mt-4">
                            <slot name="content"></slot>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-100 text-right">
                        <slot name="footer"></slot>
                    </div>
                </div>

                <div v-if="showModal && viewAs === 'image'"
                     class="shadow-xl transform transition-all max-h-screen align-middle items-center"
                     aria-labelledby="modal"
                     aria-modal="true"
                     role="document"
                     tabindex="-1"
                     :class="maxWidth">
                        <slot name="content"></slot>
                </div>
            </transition>
    </div>

</template>

<script>
export default {
    name: "Modal",
    props: {
        maxWidth: {
            type: String,
            default: 'sm:max-w-2xl',
            // 'sm': 'sm:max-w-sm',
            // 'md': 'sm:max-w-md'
            // 'lg': 'sm:max-w-lg'
            // 'xl': 'sm:max-w-xl'
            // '2xl': 'sm:max-w-2xl'
            // '5xl': 'sm:max-w-5xl'
            // '6xl': 'sm:max-w-6xl'
            // 'full': 'sm:max-w-full'
        },
        modalId: {
            type: String,
            default: 'default'
        },
        viewAs: {
            type:String,
            default: 'card'
        }
    },
    data: () => ({
        showModal: false
    }),
    methods: {
        open() {
            Event.$on(`${this.modalId}:open`, () => {
                this.showModal = true
            })
        },
        close() {
            Event.$on(`${this.modalId}:close`, () => {
                this.showModal = false
            })
        }
    },
    watch: {
        showModal () {
            if (this.showModal) {
                document.body.classList.add('overflow-y-hidden', 'xs:mr-2')
                document.getElementById(this.modalId).attributes.id.value
            } else {
                setTimeout(() => {
                    document.body.classList.remove('overflow-y-hidden', 'xs:mr-2')
                }, 200)
            }
        }
    },
    mounted() {
        this.open()
        this.close()
    }
}
</script>
