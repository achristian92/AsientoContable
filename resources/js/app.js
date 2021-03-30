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


Vue.component('payrolls-data-table', require('./components/payrolls/PayrollShow').default);


Vue.component('add-plan-account', require('./components/plan-account/AddPlanAccount').default);



//Vue.component('add-user', require('./components/users/AddUser').default);
Vue.component('user-form', require('./components/users/UserForm').default);

Vue.component('month-assign-show', require('./components/assign-costs/List').default);
Vue.component('add-cost-to-employee', require('./components/assign-costs/partials/AssignCenterCost').default);
Vue.component('show-cost-from-employee', require('./components/assign-costs/partials/ShowCostAssign').default);


Vue.component('validation-errors', require('./components/shared/ValidationErrors').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import customer from './mixins/customer'
Vue.mixin(customer);

const app = new Vue({
    el: '#app',
});
