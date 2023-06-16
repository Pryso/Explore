<template>
<input @click.prevent="getUser" type="submit">
</template>

<script>
export default {
    name: "Get",
    methods: {
        getUser() {
            axios.get('/api/get').then(response => {
                console.log(response);
            })
        }
    }
}
</script>

<style scoped>

</style>
