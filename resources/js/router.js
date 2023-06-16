import { createRouter, createWebHistory} from "vue-router";
import store from './store/index.js'
// сделать проверку на авторизацию при переходе по роуту
const routes = [
    {
        path: '/',
        name: 'index',
        component: () => import("./components/ProductsIndex.vue"),
    },
    {
        path: '/product/:id',
        name: 'product',
        component: () => import("./components/Product.vue"),
    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import("./components/Profile.vue"),
    },
    {
        path: '/product/add',
        name: 'add-product',
        component: () => import("./components/AddProduct.vue"),
        meta: {auth: true},
    },
    { path: '/:pathMatch(.*)*' , redirect: '/', },
]
const router = createRouter({
    history: createWebHistory(),
    routes,
})
router.beforeEach((to, from, next) => {
    const requireAuth = to.matched.some(record => record.meta.auth);
    const user = store.state.user;
    if(requireAuth && user === 1) {
        next('/');
    } else {
        next();
    }

})

export default router;
