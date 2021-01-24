<template>
    <div class="flex-wrap md:flex sm:justify-center mt-3">

        <!--        <template v-for="propertyChunk in properties">-->

        <business-card></business-card>
        <business-card></business-card>
        <business-card></business-card>

        <!--        </template>-->

    </div>
</template>

<script>
import BusinessCard from "../../components/Businesses/BusinessCard";
export default {
    name: "ExploreBusinesses",
    components: {
        BusinessCard,
    }
}
</script>

<style scoped>

</style>
