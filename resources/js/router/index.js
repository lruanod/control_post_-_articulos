import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home.vue';
import Register from '../pages/Register.vue';
import Login from '../pages/Login.vue';
import Dashboard from '../pages/Dashboard.vue';
import Posts from '../Components/Posts.vue';
import Articulos from '../Components/Articulos.vue';
import EditPost from '../Components/EditPost.vue';
import EditArticulo from '../Components/EditArticulo.vue';
import AddPost from '../Components/AddPost.vue';
import AddArticulo from '../Components/AddArticulo.vue';





export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'posts',
        path: '/posts',
        component: Posts
    },
    {
        name: 'articulos',
        path: '/articulos',
        component: Articulos
    },
    {
        name: 'addpost',
        path: '/posts/add',
        component: AddPost
    },
    {
        name: 'addarticulo',
        path: '/articulos/add',
        component: AddArticulo
    },
    {
        name: 'editpost',
        path: '/posts/edit/:id',
        component: EditPost
    },
    {
        name: 'editarticulo',
        path: '/articulos/edit/:id',
        component: EditArticulo
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
