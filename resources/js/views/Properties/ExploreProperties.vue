<template>
    <div class="flex-wrap md:flex sm:justify-center mt-3">

<!--        <template v-for="propertyChunk in properties">-->

        <property-card></property-card>

<!--        </template>-->

    </div>
</template>

<script>
import PropertyCard from '../../components/Properties/PropertyCard'

export default {
    name: "ExploreProperties",
    components: {
        PropertyCard,
    }
}
</script>

<style scoped>

</style>
