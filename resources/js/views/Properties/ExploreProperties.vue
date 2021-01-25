<template>
    <div class="flex-wrap md:flex sm:justify-center mt-3">

        <template v-for="propertyChunk in properties">

            <property-card v-for="property in propertyChunk"
                           :key="property.id"
                           :property="property"
            ></property-card>

        </template>

    </div>
</template>

<script>
import PropertyCard from '../../components/Properties/PropertyCard'

export default {
    name: "ExploreProperties",
    data() {
        return {
            endpoint: '/api/properties',
            properties: [],
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint).then(response => {
                this.properties = response.data.data
            }).catch(error => dd(error))
        },
    },
    mounted() {
        this.index()
    },
    components: {
        PropertyCard,
    }
}
</script>

<style scoped>

</style>
