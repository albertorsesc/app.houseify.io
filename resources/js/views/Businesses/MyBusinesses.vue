<template>
    <div>
        <div class="items-center flex justify-center">
            <svg v-show="menuTab === 'my-businesses'"
                 @click="toggle"
                 class="cursor-pointer h-6 w-6 text-emerald-300 hover:h-10 hover:w-10 hover:text-emerald-400 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg v-show="menuTab === 'new-business'"
                 @click="toggle"
                 class="cursor-pointer h-6 w-6 text-emerald-300 hover:h-10 hover:w-10 hover:text-emerald-400 transition duration-150 ease-in-out"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
        </div>
        <div v-show="menuTab === 'new-business'">
            <create-business :categories="categories"></create-business>
        </div>
        <div v-show="menuTab === 'my-businesses'"
             class="flex-wrap md:flex sm:justify-center mt-3">

            <business-card v-for="business in myBusinesses"
                           :key="business.id"
                           :business="business"
            ></business-card>

        </div>
    </div>

</template>

<script>
import CreateBusiness from "./CreateBusiness";
import BusinessCard from "../../components/Businesses/BusinessCard";

export default {
    name: "MyBusinesses",
    props: {
        categories: {
            type: Array,
            required: true,
        }
    },
    data() {
        return {
            endpoint: '/api/me/businesses',
            myBusinesses: [],
            menuTab: 'my-businesses'
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint).then(response => {
                this.myBusinesses = response.data.data
            }).catch(error => dd(error))
        },
        toggle() {
            this.menuTab = this.menuTab === 'my-businesses' ? 'new-business' : 'my-businesses'
        }
    },
    mounted() {
        this.index()
        Event.$on('businesses.new-business', (business) => {
            this.myBusinesses.unshift(business)
            this.menuTab = 'my-businesses'
        })
    },
    components: {
        BusinessCard,
        CreateBusiness,
    }
}
</script>
