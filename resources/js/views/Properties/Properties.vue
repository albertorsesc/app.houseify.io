<script>
import {mapGetters} from "vuex";

export default {
    name: 'Properties',
    data: function () {
        return {
            endpoint: '/properties',
            properties: [],

            activeTab: 'explore-properties',
            headerTitle: 'Propiedades',
        }
    },
    methods: {
        index () {
            /*axios.get(this.endpoint).then(response => {
                this.properties = response.data.data
            }).catch(error => dd(error))*/
        },
        nav(to) {
            this.activeTab = to
        }
    },
    watch: {
        activeTab() {
            if (this.activeTab === 'explore-properties') {
                this.headerTitle = 'Propiedades'
            }
            if (this.activeTab === 'my-properties') {
                this.headerTitle = 'Mis Propiedades'
            }
            if (this.activeTab === 'interesting-properties') {
                this.headerTitle = 'Mis Intereses'
            }
            if (this.activeTab === 'search-properties') {
                this.headerTitle = 'Búsqueda Avanzada de Propiedades'
            }
        }
    },
    mounted() {
        // this.$store.dispatch('global/fetchStates')
        // this.$store.dispatch('properties/fetchPropertyTypes')
        // this.$store.dispatch('properties/fetchBusinessTypes')
    },
    components: {
        SearchProperties: () => import(/* webpackChunkName: "search-properties" */ './SearchProperties'),
        MyProperties: () => import(/* webpackChunkName: "my-properties" */ '../../views/Properties/MyProperties'),
        InterestingProperties: () => import(/* webpackChunkName: "interesting-properties" */ './InterestingProperties'),
        ExploreProperties: () => import(/* webpackChunkName: "explore-properties" */ '../../views/Properties/ExploreProperties'),
    }
}
</script>
