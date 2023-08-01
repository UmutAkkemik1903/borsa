require('./bootstrap');
window.Vue = require('vue');

import App from './components/App';
import router from './router/index';
import Vue from "vue";

const app = new Vue({
    el: '#app',
    template:'<App/>',
    components:{App},
    router
});



