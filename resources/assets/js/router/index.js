import VueRouter from 'vue-router';
import Vue from "vue";
import Home from '../views/Home';
import Locations from '../views/Locations';
import Tracking from '../views/Tracking';
import Shipments from '../views/Shipments';
import Status from '../views/Status';
import Track from '../views/Track';
import NotFoundComponent from '../components/NotFoundComponent';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    base: 'home',
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
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
            component: Tracking,
            children: [
                {
                  path: '',
                  redirect: 'track'
                },
                {
                    path: 'track',
                    name: 'track',
                    component: Track
                },
                {
                    path: 'status',
                    name: 'status',
                    component: Status
                }
            ]
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