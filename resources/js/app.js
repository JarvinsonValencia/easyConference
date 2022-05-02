/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
window.Vue.use(BootstrapVue);
window.Vue.use(IconsPlugin);

/**
 * ElementUI - biblioteca para interfaz usuario
 */
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
window.Vue.use(ElementUI);


/**
 * SweetAlert2 - biblioteca para ventanas emergentes
 */
import Swal from 'sweetalert2'
window.Swal = Swal;

/**
 * VeeValidate - biblioteca para validaciones
 */
 import Vuelidate from 'vuelidate'
 window.Vue.use(Vuelidate)

/**
 * EventBus - biblioteca para comunicacion entre componentes
 */
 export const EventBus = new Vue();
 window.EventBus = EventBus;

import VTooltip from 'v-tooltip'
window.Vue.use(VTooltip);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('App', require('./components/App.vue').default);
Vue.component('Auth', require('./components/Auth.vue').default);
Vue.component('Activity', require('./components/modules/activity/Index.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from './routes'
const app = new Vue({
    el: '#app',
    router
});
