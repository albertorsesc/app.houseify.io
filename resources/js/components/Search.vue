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
                'LC62QI1NJT',
                '5b6eaf701b123679d0ac645b8d53d811',
            )
        }
    },
}
</script>

<style scoped>

</style>
