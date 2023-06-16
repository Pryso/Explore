<template>

    <div class="qwe-2">

        <div class="menu">
            <div class="logo">
                <img :src="'../img/TRADEBID logotype.svg'">
            </div>
            <hr class="qwe-1">
            <template v-if="!this.auth_user">
            <div class="auth">
                <button class="btn-1" v-on:click="toggleModal">Войти</button>
                <button class="btn-1">Регистрация</button>
            </div>
            </template>
            <template v-if="this.auth_user">
                <span>
                    {{ this.auth_user.name }}
                </span>
                <span>Баланс: {{this.auth_user.balance}}</span>
                <a v-on:click="logout">Выйти</a>
            </template>
            <hr class="qwe-1">
            <div class="nav">
                <div class="nav-element nav-element-active">
                    Товары
                </div>
                <div class="nav-element">
                    Продать
                </div>
                <router-link to="/profile">Профиль</router-link>
                <router-link to="/product/add">Добавить товар</router-link>
            </div>
        </div>
        <div class="clear-menu"></div>

        <router-view>
        </router-view>

        <template v-if="isModal">
            <modal-auth @setUser="auth_user = $event" @closeModal="isModal = $event"></modal-auth>
        </template>

    </div>
</template>

<script>
export default {
    name: "Index",
    props: ["user"],

    mounted() {
        if(!this.user) {
            this.$store.state.user = 1;
        } else {
            this.auth_user = this.user;
            this.$store.state.user = this.user;
        }


    },
    data() {
        return {
            auth_user: null,
            isModal: false,

        }
    },
    methods: {
        toggleModal() {
            this.isModal = !this.isModal;
        },
        logout() {
            axios.post('/logout').then(r => {
                console.log(r);
            })
            this.$store.state.user = 1;
            this.$router.push('/');
            window.location.reload();
        }
    }
}
</script>

<style scoped>

</style>
