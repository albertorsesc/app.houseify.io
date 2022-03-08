<template>
    <div class="w-full">
        <div class="w-2/3">
            <input type="text"
                   id="search"
                   v-model="query"
                   @keyup="search"
                   autocomplete="search"
                   class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                   placeholder="Busca por Nombre o Descripcion del Producto...">
        </div>

        <ul role="list" class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <li v-for="product in products" :key="product.id" class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                <div class="w-full flex items-center justify-between px-6 py-4 space-x-6">
                    <div class="flex-1 truncate">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-gray-900 text-base font-medium truncate" v-text="product.name"></h3>
                            <!--<span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Admin</span>-->
                        </div>
                        <p class="mt-2 truncate flex">
                            <span class="text-gray-500 text-sm">En Almacen: </span>
                            <span class="flex">
                                <span v-text="product.inStock" class="ml-2 text-gray-700 text-sm"></span>
                                <span v-text="product.storageUnit" class="ml-1 text-gray-700 text-sm"></span>
                            </span>
                        </p>
                        <p class="mt-2 truncate flex">
                            <span class="text-gray-500 text-sm">Precio Unitario: </span>
                            <span v-text="product.unitPrice" class="ml-2 text-gray-700 text-sm"></span>
                        </p>
                    </div>
<!--                    <img class="w-28 h-28 bg-gray-300 rounded-lg flex-shrink-0" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">-->
                </div>
                <div v-if="business.owner.id === auth">
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="w-0 flex-1 flex">
                            <div @click="openModal(product)" class="cursor-pointer relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span class="ml-3">Editar</span>
                            </div>
                        </div>
                        <div class="-ml-px w-0 flex-1 flex">
                            <div @click="onDelete(product)" class="cursor-pointer relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-3">Eliminar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <modal modal-id="update-product" max-width="sm:max-w-md">
            <template #title>Actualizar Producto</template>
            <template #content>
                <form @submit.prevent>
                    <div class="w-full">
                        <div class="w-full">
                            <label for="name">
                                <strong class="required">*</strong>
                                Nombre del Producto
                                <span class="text-gray-500 font-light text-xs">(requerido)</span>
                            </label>
                            <div class="my-1 flex rounded-md shadow-sm">
                                <input type="text"
                                       id="name"
                                       v-model="productForm.name"
                                       autocomplete="name"
                                       class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                            </div>
                            <errors :error="errors.name"
                                    :options="{ noContainer: true }"
                            ></errors>
                        </div>
                        <div class="mt-2 w-full">
                            <label for="in_stock">
                                En Almacen
                                <span class="text-gray-500 font-light text-xs">(opcional)</span>
                            </label>
                            <div class="my-1 flex rounded-md shadow-sm">
                                <input type="text"
                                       id="in_stock"
                                       v-model="productForm.inStock"
                                       autocomplete="in_stock"
                                       class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                            </div>
                            <errors :error="errors.in_stock"
                                    :options="{ noContainer: true }"
                            ></errors>
                        </div>
                        <div class="mt-2 w-full">
                            <label for="storage_unit">
                                Unidad de Almacenaje
                                <span class="text-gray-500 font-light text-xs">(opcional)</span>
                            </label>
                            <div class="my-1 flex rounded-md shadow-sm">
                                <select v-model="productForm.storageUnit"
                                        id="storage_unit"
                                        class="h-select">
                                    <option value="">Selecciona una Unidad</option>
                                    <option value="pz">Pieza</option>
                                    <option value="caja">Caja</option>
                                    <option value="mt">Metro</option>
                                </select>
                            </div>
                            <errors :error="errors.storage_unit"
                                    :options="{ noContainer: true }"
                            ></errors>
                        </div>
                        <div class="mt-2 w-full">
                            <label for="unit_price">
                                Precio Unitario
                                <span class="text-gray-500 font-light text-xs">(opcional)</span>
                            </label>
                            <div class="my-1 flex rounded-md shadow-sm">
                                <input type="text"
                                       id="unit_price"
                                       v-model="productForm.unitPrice"
                                       autocomplete="unit_price"
                                       class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                            </div>
                            <errors :error="errors.unit_price"
                                    :options="{ noContainer: true }"
                            ></errors>
                            <p class="mt-1 text-xs text-gray-500">Precio en Moneda Nacional.</p>
                        </div>
                        <div class="mt-2 w-full">
                            <label for="unit_price">
                                Descripcion
                                <span class="text-gray-500 font-light text-xs">(opcional)</span>
                            </label>
                            <div class="my-1 flex rounded-md shadow-sm">
                                <textarea id="description"
                                          v-model="productForm.description"
                                          rows="6"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                ></textarea>
                            </div>
                            <errors :error="errors.description"
                                    :options="{ noContainer: true }"
                            ></errors>
                        </div>
                    </div>
                </form>
            </template>
            <template #footer>
                <button @click="closeModal()"
                        type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                    Cancelar
                </button>
                <button @click="update"
                        class="h-link ml-2 mt-2 md:mt-0 inline-flex items-center justify-center px-4 py-2 bg-teal-500 border border-gray-200 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:font-semibold hover:shadow-lg hover:bg-teal-400 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                    Guardar
                </button>
            </template>
        </modal>
    </div>
</template>

<script>

import SweetAlert from "../../../models/SweetAlert";

export default {
    name: "Products",
    inject: ['business'],
    data() {
        return {
            productsEndpoint: `businesses/${this.business.slug}/products`,
            products: [],
            product: {},
            productForm: {},

            query: '',
            modal: {},
            errors: [],
        }
    },
    methods: {
        index() {
            axios.get(this.productsEndpoint)
            .then(response => {
                this.products = response.data.data
            })
            .catch(error => {
                console.log(error)
            })
        },
        update() {
            axios.put(`${this.productsEndpoint}/${this.productForm.id}`, {
                name: this.productForm.name,
                unit_price: this.productForm.unitPrice,
                in_stock: this.productForm.inStock,
                storage_unit: this.productForm.storageUnit,
                description: this.productForm.description
            })
                .then(() => {
                    SweetAlert.toast('Producto actualizado!')
                    this.index()
                    this.closeModal()
                })
                .catch(errors => this.errors = errors.response.status === 422 ?
                    errors.response.data.errors :
                    [])
        },
        destroy() {
            axios.delete(`${this.productsEndpoint}/${this.product.id}`)
                .then(() => {
                    SweetAlert.toast('Producto Eliminado exitosamente!')
                    this.index()
                }).catch(error => { console.log(error) })
        },
        onDelete(product) {
            this.product = product
            if (confirm('Deseas eliminar este Producto: ' + product.name)) {
                this.destroy()
            }
        },
        search() {
            if (this.query.length === 0) {
                this.index();
            }
            if (this.query.length < 3) {
                return;
            }
            axios.get(this.productsEndpoint, {
                params: { query: this.query }
            })
            .then(response => {
                this.products = response.data.data
            })
            .catch(error => {
                console.log(error)
            })
        },
        openModal(product) {
            this.modal = {}
            this.errors = []

            this.modal.id = 'update-product'

            this.productForm.id = product.id
            this.productForm.name = product.name
            this.productForm.unitPrice = product.unitPrice
            this.productForm.inStock = product.inStock
            this.productForm.storageUnit = product.storageUnit
            this.productForm.description = product.description

            window.Event.$emit(`${this.modal.id}:open`)
        },
        closeModal() {
            window.Event.$emit(`${this.modal.id}:close`)
            this.errors = []
            this.modal = {}
            this.productForm = {}
        },
    },
    mounted() {
        this.index()

        window.Event.$on('businesses.products.product-created', product => {
            this.products.unshift(product)
        })
    },
    components: {
        Errors: () => import(/* webpackChunkName: "errors" */ '../../../components/Errors'),
        Modal: () => import(/* webpackChunkName: "modal" */ '../../../components/Modal'),
    }
}
</script>

<style scoped>

</style>
