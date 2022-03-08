<template>
    <div>
        <div v-if="isOwnerOfBusiness" class="items-center flex justify-center">
            <svg v-show="inventoryTab === 'products'"
                 @click="toggle"
                 class="h-transform h-transition cursor-pointer h-8 w-8 text-emerald-300 hover:h-12 hover:w-12 hover:text-emerald-400 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg v-show="inventoryTab === 'create-product'"
                 @click="toggle"
                 class="h-transform h-transition cursor-pointer h-8 w-8 text-emerald-300 hover:h-12 hover:w-12 hover:text-emerald-400 "
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
        </div>

        <div v-if="inventoryTab === 'products'" class="mt-8">
            <products></products>
        </div>

        <div v-if="inventoryTab === 'create-product' && isOwnerOfBusiness"
             class="mt-8">
            <create-product></create-product>
        </div>

    </div>
</template>

<script>

export default {
    name: "BusinessInventory",
    inject: ['business'],
    data() {
        return {
            inventoryTab: 'products',
            localBusiness: this.business,
            isOwnerOfBusiness: false,
        }
    },
    methods: {
        toggle() {
            this.inventoryTab = this.inventoryTab === 'products' ? 'create-product' : 'products'
        }
    },
    mounted() {
        this.isOwnerOfBusiness = this.localBusiness.owner.id === this.auth;
        window.Event.$on('businesses.products.product-created', (product) => {
            this.inventoryTab = 'products'
        })
    },
    components: {
        Products: () => import(/* webpackChunkName: "products" */ './Products'),
        CreateProduct: () => import(/* webpackChunkName: "create-product" */ './CreateProduct'),
    },


}
</script>
