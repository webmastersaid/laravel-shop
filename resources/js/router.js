import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        component: () => import('./views/main/Index.vue'),
        name: 'main.index'
    },
    {
        path: '/products',
        component: () => import('./views/products/Index.vue'),
        name: 'products.index'
    },
    {
        path: '/products/:id',
        component: () => import('./views/products/Show.vue'),
        name: 'products.show'
    },
    {
        path: '/cart',
        component: () => import('./views/cart/Index.vue'),
        name: 'cart.index'
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;