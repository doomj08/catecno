/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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
Vue.component('sidebar-component', require('./components/SidebarComponent.vue').default);
Vue.component('topbar-component', require('./components/TopbarComponent.vue').default);
Vue.component('footer-component', require('./components/FooterrComponent').default);
Vue.component('tabla-component', require('./components/TablaComponent').default);
Vue.component('crear-component', require('./components/CrearComponent').default);
Vue.component('editar-component', require('./components/EditarComponent').default);
Vue.component('spinner-component', require('./components/SpinnerComponent').default);
Vue.component('f-input-component', require('./components/InputComponent').default);
Vue.component('pdf-component', require('./components/PdfComponent').default);
Vue.component('file-component', require('./components/FileComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import swal from 'sweetalert2'
window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
window.toast = toast;
const app = new Vue({
    el: '#app',
});
