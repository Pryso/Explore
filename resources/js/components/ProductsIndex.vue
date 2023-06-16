<template>
    <div class="main">
        <div class="content">
            <div class="filter-section" >
                <div class="search">
                    <input type="text" placeholder="Введите текст для поиска...">
                </div>
                <div class="category">
                    <div class="btn-2" style="width: 140px; margin-right: 20px" v-on:click.self="this.block.game = !this.block.game">
                        {{ this.filter.place }}
                        <template v-if="this.block.game">
                        <div class="select-game">
                            <div class="qwe-20" v-on:click="setPlace('Dota 2')">
                                Dota 2
                            </div>
                            <div class="qwe-20" v-on:click="setPlace('STALCRAFT')">
                                STALCRAFT
                            </div>
                        </div>
                        </template>
                    </div>
                    <div class="btn-2">Выберите категорию</div>
                </div>
            </div>

            <div class="product-section">
                <div class="products row">
                    <template v-if="products">
                    <template v-for="product in products">
                    <router-link :to="'/product/' + product.id" class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                {{ product.category.place }}
                            </div>
                            <div class="card-text">
                                    <span class="qwe-3">{{
                                            product.short_desc
                                        }}</span>
                            </div>
                            <div class="card-seller">
                                <span>{{ product.seller.name }}</span>
                                <div class="card-price">
                                    {{product.price}} P
                                </div>
                            </div>
                        </div>
                    </router-link>
                    </template>
                    </template>
                    <template v-if="!products">
                        <template v-for="n in 15">
                            <div  class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="load-card">
                                    <div class="anim"></div>
                                </div>
                            </div>
                        </template>
                    </template>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
export default {
    name: "ProductsIndex",
    data() {
        return {
            filter: {
                place: 'Выберите игру',
                type: null,
                sort: null,
            },
            block: {
                game: false,
                category: false,
            },
            products: null,
        }
    },
    methods: {
        setPlace(place) {
            this.filter.type = null;
            this.filter.place = place;
            this.block.game = !this.block.game;
            const data = {
                place: this.filter.place
            };
            this.filterProduct(data);
        },
        filterProduct(data) {
            this.products = null;
            axios.post('/api/product/filter', {data}).then(res => {
                this.products = res.data.data;
            })
        },
        getProducts() {
            axios.get('/api/product').then(res => {
                this.products = res.data.data;
            })
        }
    },
    mounted() {
        this.getProducts();
    }
}
</script>

<style scoped>
.loading {
    width: 100%;
    height: 100vh;

}

</style>
