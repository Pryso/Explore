<template>
<div>
    <input type="text" v-model="email">
    <input type="password" v-model="password">
    <input @click.prevent="login" type="submit">
</div>
    <div>
        <h3>Product</h3>
        <input type="text" v-model="price">
        <input type="text" v-model="short_desc">
        <input type="text" v-model="desc">
        <input type="text" v-model="category_id">
        <input type="text" v-model="datas">
        <input type="submit" @click.prevent="product">
    </div>
    <div>
        <input type="text" v-model="rate">
        <input type="submit" @click.prevent="review">
    </div>
    <div>
        <input type="hidden" v-model="proda">
        <input type="submit" @click.prevent="buy">
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            datas: null,
            proda: 1,
            rate: null,
            product_id: null,
            email: null,
            password: null,
            short_desc: null,
            desc: null,
            price: null,
            category_id: null,
        }
    },
    methods: {
        buy() {
            axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/product/' + this.proda + '/buy').then(r => {
                    console.log(r);
                })
            })
        },
        review() {
            axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/product/' + this.proda + '/review', {
                    rate: this.rate,
                }).then(r => {
                    console.log(r);
                })
            })
        },
        product() {
            axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/product', {
                    price: this.price,
                    desc: this.desc,
                    short_desc: this.short_desc,
                    category_id: this.category_id,
                    account: this.datas,
                }).then(r => {
                    console.log(r);
                })
            })
        },
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                }).then( r => {
                    console.log(r);
                })
            });

        }
    }
}
</script>

<style scoped>

</style>
