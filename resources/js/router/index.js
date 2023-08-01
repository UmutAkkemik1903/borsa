import Vue from "vue";
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Content from "../components/pages/AdminPanel/Content/Content";
import AboutUs from "../components/pages/AdminPanel/Settings/About/AboutUs";
import Header from "../components/pages/AdminPanel/Settings/Header/Header";
import Footer from "../components/pages/AdminPanel/Settings/Footer/Footer";
import Magazine from "../components/pages/AdminPanel/Magazine/Magazine";
import hakkimizda from "../components/pages/Main/About-us";
import DashBoard from "../components/pages/Main/DashBoard";
import magazineDetail from "../components/pages/Main/MagazineDetail";
import contentDetail from "../components/pages/Main/ContentDetail";
import contentList from "../components/pages/Main/ContentList";
import dashBoard from "../components/pages/AdminPanel/dashBoard";
const routes = [
    {
        path:'/content',
        component:Content,
        name:'content'

    },
    {
        path:'/aboutus',
        component: AboutUs,
        name:'about'
    },
    {
        path:'/header',
        component:Header,
        name:'header'
    },
    {
        path:'/footer',
        component:Footer,
        name:'footer'
    },
    {
        path: '/magazine',
        component: Magazine,
        name: 'magazine'
    },
    {
        path: '/',
        component: DashBoard,
        name: 'dashboard',
    },
    {
        path: '/Hakkımızda',
        component: hakkimizda,
        name: 'hakkimizda'
    },
    {
        path: '/magazine-detail/:id',
        component: magazineDetail,
        name: 'magazine-detail',
    },
    {
        path: '/content-detail/:id',
        component:contentDetail,
        name: 'content-detail',
    },
    {
        path: '/contentList',
        component:contentList,
        name: 'contentList',
    },
    {
        path: '/',
        component:dashBoard,
        name: 'dashBoard',
    },

]


export default new VueRouter({
    mode:'hash',
    routes
})
