/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"



const store = new Vuex.Store(
   storeData
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

//Admin
Vue.component('edit_admin-component', require('./components/admin/Edit.vue').default);
Vue.component('index_admin-component', require('./components/admin/Index.vue').default);

//Users
Vue.component('profil-component', require('./components/users/Edit.vue').default);
Vue.component('image-component', require('./components/users/ImageProfil.vue').default);

//Products
Vue.component('edit_product-component', require('./components/products/Edit.vue').default);
Vue.component('products-component', require('./components/products/Index.vue').default);
Vue.component('create_products-component', require('./components/products/Create.vue').default);
Vue.component('product-component', require('./components/products/Show.vue').default);
Vue.component('category-component', require('./components/products/Category.vue').default);

//Cart
Vue.component('count-component', require('./components/cart/Count.vue').default);
Vue.component('cart-component', require('./components/cart/index.vue').default);
//code
Vue.component('create_code-component', require('./components/code/Index.vue').default);
//Pagination
Vue.component('pagination', require('laravel-vue-pagination'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
});
