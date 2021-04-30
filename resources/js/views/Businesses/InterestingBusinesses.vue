<template>
    <div>
        <div class="flex-wrap md:flex sm:justify-center mt-3">

            <business-card v-for="business in interestedBusinesses"
                           :key="business.id"
                           :business="business"
            ></business-card>

            <div v-if="! interestedBusinesses.length" class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg">
                <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                    <div class="max-w-md">
                        <div class="text-5xl font-dark font-bold">hmm..</div>
                        <p class="text-2xl md:text-3xl font-light leading-normal">Parece que no estás interesado en ningún negocio aun. </p>
                        <p class="mb-8 mt-4">Explora Negocios y encuentra lo que necesites.</p>
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
export default {
    name: "InterestingBusinesses",
    data() {
        return {
            interestedBusinesses: [],
        }
    },
    methods: {
        getInterestingBusinesses() {
            axios.get('/me/businesses/interested').then(response => {
                this.interestedBusinesses = response.data.data
            }).catch(error => {})
        },
        onToggleInterest() {
            Event.$on('interest-businesses', () => {
               this.getInterestingBusinesses()
            })
        }
    },
    created() {
        this.getInterestingBusinesses()
        this.onToggleInterest()
    },
    components: {
        BusinessCard: () => import(/* webpackChunkName: "business-card" */ '../../components/Businesses/BusinessCard'),
    }
}
</script>

