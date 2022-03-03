<template>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
        <form @submit.prevent class="space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Nuevo Producto
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Registra los datos de tu nuevo Producto.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-6">
                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="name" class="block text-sm font-medium text-gray-700">
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
                        </div>

                        <div class="col-span-4 lg:flex md:-mx-2">
                            <div class="w-full lg:w-1/3 md:mx-2 mt-4 md:mt-0">
                                <label for="in_stock" class="block text-sm font-medium text-gray-700">
                                    En Almacen
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="number"
                                           v-model="productForm.inStock"
                                           id="in_stock"
                                           autocomplete="in_stock"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.in_stock"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <div class="w-full lg:w-1/3 md:mx-2 mt-4 md:mt-0">
                                <label for="storage_unit" class="block text-sm font-medium text-gray-700">
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
                            <div class="w-full lg:w-1/3 md:mx-2">
                                <label for="unit_price" class="block text-sm font-medium text-gray-700">
                                    Precio Unitario
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="number"
                                           v-model.number="productForm.unitPrice"
                                           id="unit_price"
                                           autocomplete="unit_price"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                           step="any">
                                </div>
                                <errors :error="errors.unit_price"
                                        :options="{ noContainer: true }"
                                ></errors>
                                <p class="mt-1 text-xs text-gray-500">Precio en Moneda Nacional.</p>
                            </div>
                        </div>

                        <!--Comments-->
                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Descripcion
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="mt-1">
                                <textarea id="description"
                                          v-model="productForm.description"
                                          rows="6"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                ></textarea>
                                </div>
                                <errors :error="errors.description"
                                        :options="{ noContainer: true }"
                                ></errors>
                                <p class="mt-2 text-sm text-gray-500">Escribe una descripcion del Producto.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <a :href="`/directorio-de-negocios/${this.business.slug}`"
                       class="ml-3 h-btn">
                        Cancelar
                    </a>
                    <button @click="store"
                            type="submit"
                            class="ml-3 h-btn-success">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";

export default {
    name: "CreateProduct",
    inject: ['business'],
    data() {
        return {
            productsEndpoint: `businesses/${this.business.slug}/products`,
            productForm: {
                name: '',
                description: '',
                unitPrice: '',
                inStock: 0,
                storageUnit: '',
            },

            action: 'post',
            errors: [],
        }
    },
    methods: {
        store() {
            axios.post(this.productsEndpoint, {
                name: this.productForm.name,
                unit_price: this.productForm.unitPrice,
                in_stock: this.productForm.inStock,
                storage_unit: this.productForm.storageUnit,
                description: this.productForm.description
            })
            .then(response => {
                window.Event.$emit('businesses.products.product-created', response.data.data)
            })
            .catch(errors => this.errors = errors.response.status === 422 ?
                errors.response.data.errors :
                [])
        },
    },
    components: {
        VueMultiselect,
        Errors: () => import(/* webpackChunkName: "errors" */ '../../../components/Errors'),
    }
}
</script>
