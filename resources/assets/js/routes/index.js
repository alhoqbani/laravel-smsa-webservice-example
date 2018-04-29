import VueRouter from 'vue-router';
import Vue from "vue";
Vue.use(VueRouter);

import Home from '../views/Home'
import Locations from '../views/Locations'

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
           path: '/retails',
           name: 'retails',
           component: Locations,
       },
   ]
});