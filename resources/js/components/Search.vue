<template>
        <ais-instant-search :search-client="searchClient"
                            :index-name="index">
            <slot></slot>
        </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite'

export default {
    name: "Search",
    props: {
        index: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            searchClient: algoliasearch(
                'NF2LQQSO9Y',
                'c9449e46573cb073d99941bb75cbf778',
            )
        }
    },
}
</script>

<style scoped>

</style>
