<template>

</template>

<script>

import MyJobProfiles from "./MyJobProfiles";

export default {
    name: "JobProfiles",
    data() {
        return {
            activeTab: 'explore-job-profiles',
            headerTitle: 'Tecnicos y Profesionistas',
        }
    },
    components: {
        MyJobProfiles,
    }
}
</script>

<style scoped>

</style>
