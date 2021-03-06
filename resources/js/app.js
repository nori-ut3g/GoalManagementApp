import Vue from "vue";
import Vuetify from "./vuetify";
import VueRouter from "vue-router";

import AppComponent from "./components/AppContent";
import LogInComponent from "./components/Header/LogInComponent";
import SignUpComponent from "./components/Header/SignUpComponent";
import ObjectiveContentComponent from "./components/Objective/ObjectiveContentComponent";
import ObjectiveTableComponent from "./components/Objective/ObjectiveTableComponent";
import CreateObjectiveComponent from "./components/Objective/CreateObjectiveComponent";
import HomeComponent from "./components/HomeComponent";
import welcomeComponent from "./components/WelcomeComponent";
import SharedObjectiveComponent from "./components/Objective/SharedObjectiveComponent";
import UserSettingsComponent from "./components/UserSettingsComponent";
import SharedObjectiveTableComponent from "./components/Objective/SharedObjectiveTableComponent";


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    data(){
        return {
            isLoggedIn: false
        }
    },
    routes: [

        {
            path: '/',
            component: welcomeComponent,
            meta: { title: 'Task Management App' }
        },
        {
            path: '/home',
            component: HomeComponent,
            meta: { title: 'Task Management App' }
        },
        {
            path: '/list',
            component: ObjectiveTableComponent,
            meta: { title: 'Task Management App' }
        },
        {
            path: '/create',
            component: CreateObjectiveComponent,
            meta: { title: 'Task Management App' }
        },
        {
            path: '/objective/:id',
            component: ObjectiveContentComponent,
            meta: { title: 'Task Management App' }
        },
        {
            path: '/share/objective/:id',
            component: SharedObjectiveComponent,
            meta: { title: 'Task Management App' }
        },
        {
            path: '/UserSettings',
            component: UserSettingsComponent,
            meta: { title: 'Task Management App' }
        },
        {
            path: '/share/list',
            component: SharedObjectiveTableComponent,
            meta: { title: 'Task Management App' }
        },


    ]
    }
)
router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    next()
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


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
