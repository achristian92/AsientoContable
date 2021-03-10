/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast)


Vue.component('payrolls-index', require('./components/payrolls/Payrolls').default);
Vue.component('payrolls-data-table', require('./components/payrolls/PayrollShow').default);


Vue.component('add-plan-account', require('./components/plan-account/AddPlanAccount').default);



//Vue.component('add-user', require('./components/users/AddUser').default);
Vue.component('user-form', require('./components/users/UserForm').default);


Vue.component('add-customer', require('./components/customers/AddCustomer').default);
Vue.component('edit-customer', require('./components/customers/EditCustomer').default);


Vue.component('validation-errors', require('./components/shared/ValidationErrors').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import customer from './mixins/customer'
Vue.mixin(customer);

import routes from './mixins/routes'
Vue.mixin(routes);


const app = new Vue({
    el: '#app',
});
