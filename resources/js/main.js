require('./bootstrap');
window.Vue = require('vue');

import App from './components/pages/Main/App';
import router from './router';
import Vue from "vue";

const app = new Vue({
    el: '#app',
    template:'<App/>',
    components:{App},
    router
});



