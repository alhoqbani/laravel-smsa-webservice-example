import './bootstrap';
import './google-maps';
import Vue from 'vue';
import router from './router';

window.Vue = Vue;

Vue.component('app', require('./views/App'));

const app = new Vue({
    el: '#app',
    router,
});