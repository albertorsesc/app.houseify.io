<template>
    <carousel :data="data" :indicators="false" :interval="1200"></carousel><!---->
</template>

<script>
    import VueCarousel from '@chenfengyuan/vue-carousel';

    export default {
        name: 'CustomCarousel',
        props: {
            images: {
                type: Array,
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
                data: [],
            }
        },
        methods: {
            displayImages() {
                /*if (this.images.length > 0) {
                    for (let i = 0; i < this.images.length; i++) {
                        let img = window.location.origin + `/img/${this.size}/${this.images[i].path.split('public/').pop()}`

                        this.data.push('<img class="d-block h-full w-full object-cover rounded-lg" src="' + img + '">')
                    }
                } else {*/
                    this.data.push('<img class="d-block h-full w-full object-cover rounded-lg" src="/img/' + this.moduleName + '.png">')
                /*}*/
            },
        },
        components: {
            VueCarousel
        },
        mounted() {
            this.displayImages()
        }
    }
</script>
