<template>
    <div>
        <div class="flex-wrap md:flex sm:justify-center mt-3">

            <property-card v-for="property in interestedProperties"
                           :key="property.id"
                           :property="property"
            ></property-card>

            <div v-if="! interestedProperties.length" class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg">
                <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                    <div class="max-w-md">
                        <div class="text-5xl font-dark font-bold">hmm..</div>
                        <p class="text-2xl md:text-3xl font-light leading-normal">Parece que no estas interesado en ninguna propiedad aun. </p>
                        <p class="mb-8 mt-4">Explora Propiedades tal vez encuentres algo que te agrade.</p>
                    </div>
                    <div class="max-w-lg">
                        <img src="/img/space.svg" alt="Houseify.io image">
                    </div>

                </div>
            </div>

        </div>
    </div>

</template>

<script>
import PropertyCard from "../../components/Properties/PropertyCard";

export default {
    name: "InterestingProperties",
    data() {
        return {
            interestedProperties: [],
        }
    },
    methods: {
        getInterestingProperties() {
            axios.get('/me/properties/interested')
            .then(response => {
                this.interestedProperties = response.data.data
            })
            .catch(error => { dd(error) })
        },
        onToggleInterest() {
            Event.$on('interest-properties', () => {
               this.getInterestingProperties()
            })
        }
    },
    created() {
        this.getInterestingProperties()
        this.onToggleInterest()
    },
    components: {
        PropertyCard,
    }
}
</script>

