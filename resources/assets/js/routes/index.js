import VueRouter from 'vue-router';
import Vue from "vue";
import Home from '../views/Home';
import Locations from '../views/Locations';
import Tracking from '../views/Tracking';
import Shipments from '../views/Shipments';
import NotFoundComponent from '../components/NotFoundComponent';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    base: 'home',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/locations',
            name: 'locations',
            component: Locations,
        },
        {
            path: '/tracking',
            name: 'tracking',
            component: Tracking,
        },
        {
            path: '/shipments',
            name: 'shipments',
            component: Shipments,
        },
        {
            path: '*',
            component: NotFoundComponent
        }

    ]
});