<template>
<div class="popup">
    <div class="popup-inner">
        <div class="popup-header">
            Вход
        </div>
        <div class="popup-main">
            <div class="form-input">
                <label>Почта</label>
                <input type="text" v-model="email">
            </div>
            <div class="form-input">
                <label>Пароль</label>
                <input type="password" v-model="password">
            </div>
            <div class="btn-1" v-on:click.self="login">Войти</div>
            <div class="nav-element">Регистрация</div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "ModalAuth",
    data() {
        return {
            email: null,
            password: null,
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                }).then( r => {
                    axios.get('/api/user').then(r => {
                        this.$emit("setUser", r.data);
                        this.$emit("closeModal", false);
                        this.$store.state.user = r.data;
                        console.log(r.data);
                    })

                })
            });

        },
    },
}
</script>

<style scoped>
.popup-main {
    padding: 20px;
}
.popup-main > .nav-element {
    margin-top: 10px;
}
.popup-main > .btn-1 {
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.popup-header {
    padding: 20px;
    font-family: Montserrat-Medium;
    font-size: 24px;
    border-bottom: 2px solid rgba(0, 0, 0, 0.05);
}
.popup-inner {
    display: flex;
    flex-direction: column;
    background: white;
    width: 400px;
    border-radius: 12px;
    box-shadow: 0px 2px 12px rgba(115, 128, 236, 0.15);
}
.popup {

    background: rgba(0,0,0, .2);
    position: fixed;
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
    z-index: 2;
    top: 0;
    left: 0;
    justify-content: center;

}
</style>
