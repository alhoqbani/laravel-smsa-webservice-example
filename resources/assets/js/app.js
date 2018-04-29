import './bootstrap';
import Vue from 'vue';
import router from './routes';
import App from './views/App';

window.Vue = Vue;

Vue.component('app', require('./views/App'));

const app = new Vue({
    el: '#app',
    router,
});