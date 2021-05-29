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
                window.ALGOLIA_APP_ID,
                window.ALGOLIA_SEARCH_ONLY_KEY,
            )
        }
    },
}
</script>

<style scoped>

</style>
