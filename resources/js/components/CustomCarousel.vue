<template>
    <vue-carousel :data="data" :indicators="false" :interval="1200"></vue-carousel><!---->
</template>

<script>
    import VueCarousel from '@chenfengyuan/vue-carousel';

    export default {
        name: 'CustomCarousel',
        props: {
            images: {
                type: Array|Object,
                required: false,
            },
            moduleName: {
                type: String,
                required: true,
            },
            size: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                localImages: this.images,
                data: [],
            }
        },
        methods: {
            displayImages() {
                if (this.localImages && this.localImages.length > 0) {
                    for (let i = 0; i < this.localImages.length; i++) {
                        let img
                        if (process.env.MIX_NODE_ENV !== 'production') {
                            img = window.location.origin + `/img/${this.size}/${this.localImages[i].file_name.split('public/').pop()}`
                        } else {
                            img = `${this.localImages[i].file_name}`
                        }

                        this.data.push('<img class="d-block h-full w-full object-fit rounded-lg" src="' + img + '" loading="lazy">')
                    }
                } else {
                    this.data.push('<img class="d-block h-full w-full object-cover rounded-lg" src="/img/' + this.moduleName + '.png" loading="lazy">')
                }
            },
        },
        components: {
            VueCarousel
        },
        mounted() {
            this.displayImages()

            window.Event.$on('properties-images-destroy', images => {
                this.localImages = images
                this.data = []
                this.displayImages()
            })
        }
    }
</script>
