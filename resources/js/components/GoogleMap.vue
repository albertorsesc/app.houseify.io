<template>
    <div>
        <divider title="Mapa"></divider>

        <div class="flex overflow-hidden">
            <div class="w-full bg-white rounded-lg shadow p-3">
                <div id="map" :class="mapClass"></div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: 'GoogleMap',
    props: {
        location: {
            type: Object,
            required: true,
        },
        redirectTo: {
            type: String,
            required: true,
        },
        mapClass: {
            required: false,
            type: String
        },
        zoom: {
            type: Number,
            default: 15,
            required: false,
        }
    },
    data () {
        return {
        }
    },
    methods: {
        initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: this.location.coordinates.latitude,
                    lng: this.location.coordinates.longitude
                },
                zoom: this.zoom,
            });

            new google.maps.Marker({
                position: {
                    lat: this.location.coordinates.latitude,
                    lng: this.location.coordinates.longitude,
                },
                map,
                title: this.location.fullAddress,
            });

            map.addListener('click', (e) => {
                window.location.href = this.redirectTo
            })
        }
    },
    mounted() {
        this.initMap()
    },
    components: {
        Divider: () => import(/* webpackChunkName: "divider" */ './Divider'),
    }
}
</script>
