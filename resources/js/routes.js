import Vue from 'vue';
import VueRouter from "vue-router";
import Login from './views/Login';
import Register from "./views/Register";
import Chat from "./views/Chat";
import Workspaces from "./views/Workspaces";
import Channels from "./views/Channels";

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'homepage',
            redirect: 'login'
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/workspaces',
            name: 'workspaces',
            component: Workspaces,
            props: true
        },
        {
            path: '/channels',
            name: 'channels',
            component: Channels,
            props: true
        },
        {
            path: '/chat',
            name: 'chat',
            component: Chat,
            props: true
        },
        {
            path: '*',
            name: 'Not found',
            redirect: 'login'
        }
    ]
})