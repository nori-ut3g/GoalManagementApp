import Vue from "vue";
import Vuetify from "./vuetify";
import VueRouter from "vue-router";

import WelcomeComponent from "./components/WelcomeComponent";
import AppComponent from "./components/AppContent";
import LogInComponent from "./components/LogInComponent";
import SignUpComponent from "./components/SignUpComponent";
import ObjectiveContentComponent from "./components/ObjectiveContentComponent";
import ObjectiveTableComponent from "./components/ObjectiveTableComponent";
import CreateObjectiveComponent from "./components/CreateObjectiveComponent";
import HomeComponent from "./components/HomeComponent";
import welcomeComponent from "./components/WelcomeComponent";


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'hash',
    data(){
        return {
            isLoggedIn: false
        }
    },
    routes: [
        {
            path: '/',
            name:'',
            component: welcomeComponent
        },
        {
            path: '/home',
            component: HomeComponent
        },
        {
            path: '/signup',
            component: SignUpComponent
        },
        {
            path: '/login',
            component: LogInComponent
        },
        {
            path: '/main',
            component: ObjectiveContentComponent
        },
        {
            path: '/list',
            component: ObjectiveTableComponent
        },
        {
            path: '/create',
            component: CreateObjectiveComponent
        },
        {
            path: '/objective/:id',
            component: ObjectiveContentComponent
        },

    ]
    }
)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router,
    components:{
        'app-component': AppComponent,

    }
});
