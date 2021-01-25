<script>
import ExploreProperties from '../../views/Properties/ExploreProperties'
import MyProperties from '../../views/Properties/MyProperties'

export default {
    name: 'Properties',
    data: function () {
        return {
            endpoint: '/api/properties',
            properties: [],

            activeTab: 'explore-properties',
            headerTitle: 'Propiedades',
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint).then(response => {
                this.properties = response.data.data
            }).catch(error => dd(error))
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
            if (this.activeTab === 'my-interests') {
                this.headerTitle = 'Mis Intereses'
            }
            if (this.activeTab === 'search-properties') {
                this.headerTitle = 'Busqueda Avanzada de Propiedades'
            }
        }
    },
    components: {
        MyProperties,
        ExploreProperties,
    }
}
</script>
