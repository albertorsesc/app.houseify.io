<template>
    <div class="my-2 w-full flex flex-col sm:w-2/3 md:w-1/2 lg:w-1/3 px-3">
        <div class="card transition hover:transform">
            <custom-carousel module-name="properties"></custom-carousel>
        </div>
        <div class="px-4 -mt-16 relative">
            <div class="card transition hover:transform px-6 py-4">
                <div class="flex justify-center justify-between items-center">
                    <span class="bg-teal-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
                          ></span>
                    <span class="bg-blue-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
                          ></span>
                    <span class="bg-purple-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
                          ></span>
                </div>
                <div class="font-semibold text-lg text-gray-700 mt-2 mb-2 text-center">Casa Hermosa</div>
                <div class="mb-1 text-center">
                    <span class="text-green-700 font-bold text-base">$200,000</span>
                    <span class="ml-1 text-sm text-gray-500">m.n.</span>
                </div>

                <hr>

                <div class="flex justify-center align-middle items-center mt-2">
<!--                    <interested-btn :model="property"
                                    :id="property.slug"
                                    model-name="properties"
                                    endpoint="/api/properties"
                    ></interested-btn>-->
                    <a class="inline-block text-gray-700 hover:shadow-lg hover:text-indigo-500 tracking-wide text-sm font-bold mr-2 mt-2 align-middle items-center"
                       :href="`https://www.facebook.com/sharer.php?u=` + currentUrl"
                       target="_blank"
                       title="Compartir">
                        <i class="fab fa-facebook text-blue-500 text-lg"></i>
                    </a>

                    <div class="right-0 mt-1 items-center align-middle px-4 text-green-500">
                        <!--:href="property.meta.links.profile"-->
                        <a
                           class="no-underline h-link hover:text-green-400 -mt-6"
                           title="Visitar Propiedad">
                            <i class="text-base far fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CustomCarousel from '../../components/CustomCarousel'
export default {
    data() {
        return {
            currentUrl: window.location.href,

            // propertyTitle: this.limitString(this.property.title, 24),
        }
    },
    components: {
        CustomCarousel,
    }
}
</script>
