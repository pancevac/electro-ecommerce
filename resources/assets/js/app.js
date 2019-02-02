
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('cart-holder', require('./components/CartHolder.vue'));
Vue.component('cart-add', require('./components/CartAdd.vue'));
Vue.component('cart-add-multiple', require('./components/CartAddMultple.vue'));
Vue.component('cart-remove', require('./components/CartRemove.vue'));

Vue.component('wish-list-add', require('./components/WishListAdd.vue'));

import Toast from './packages/toastConfig';
import { store } from "./store";
import { i18n } from "./packages/localization";

Vue.use(Toast);

const app = new Vue({
    el: '#app',
    store: store,
    i18n,
});
