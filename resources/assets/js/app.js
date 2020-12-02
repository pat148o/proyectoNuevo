
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

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('cargos', require('./components/Cargos.vue'));
Vue.component('clientes', require('./components/Clientes.vue'));
Vue.component('empleados', require('./components/Empleados.vue'));
Vue.component('empresas', require('./components/Empresas.vue'));
Vue.component('ent_productos', require('./components/Ent_productos.vue'));
Vue.component('facturas', require('./components/Facturas.vue'));
Vue.component('mesas', require('./components/Mesas.vue'));
Vue.component('pedidos', require('./components/Pedidos.vue'));
Vue.component('productos', require('./components/Productos.vue'));
Vue.component('prov_productos', require('./components/Prov_productos.vue'));
vue.component('proveedores',require('./components/Proveedores.vue'));
Vue.component('sali_productos', require('./components/Sali_productos.vue'));
Vue.component('tipo_productos', require('./components/tipo_productos.vue'));
Vue.component('users', require('./components/users.vue'));
const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});
