import { createApp } from 'vue'
import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
    state () {
        return {
            user: null,
            isAuth: false,
        }
    },
    mutations: {
        setUser (state, user) {
            state.user = user;
            state.isAuth = true;
        }
    },
    actions: {
        checkAuth(state) {
            axios.get('/api/user').then(r => {
                this.$store.commit('setUser',r.data)
                console.log(this.$store.state.user)
            })
            // при неудачи очистить user и isAuth поставить false
        }
    }
})

export default store;
