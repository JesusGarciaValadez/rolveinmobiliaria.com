import editClosingContract from './apps/editClosingContract'
import editContract from './apps/editContract'

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
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.events = new Vue();
window.flash = function (message, level = 'success') {
  window.events.$emit('flash', { message, level });
};

window.addEventListener("load", function(event) {
  const _ = require('lodash');

  window.trans = (string) => _.get(window.i18n, string);
  window.enumObject = (string) => _.get(window.enums, string);
  window.configObject = (string) => _.get(window.config, string);

  Vue.prototype.trans = function(string) {
    return _.get(window.i18n, string);
  }

  Vue.prototype.enumObject = function(string) {
    return _.get(window.enums, string);
  }

  Vue.prototype.configObject = function(string) {
    return _.get(window.config, string);
  }

  Vue.component('expedient', require('./components/Expedient').default)
  Vue.component('create-new-client-link', require('./components/CreateNewClientLink').default)
  Vue.component('client', require('./components/Client').default)
  Vue.component('spinner', require('./components/Spinner').default)
  Vue.component('alert', require('./components/Alert').default)
  Vue.component('select-internal-expedient', require('./components/SelectInternalExpedient').default)

  Vue.component('modal-expedient', require('./components/modal/Expedient').default)
  Vue.component('modal-client', require('./components/modal/Client').default)

  Vue.component('client-filter', require('./components/client/Filter').default)

  Vue.component('seller', require('./components/Seller').default)

  const editClosingContractRoot = document.getElementById('edit__closing-contract') || null
  const editContractRoot = document.getElementById('edit__contract') || null

  if (editClosingContractRoot !== null) {
    const $vmEditClosingContract = new Vue(editClosingContract)
  }

  if (editContractRoot !== null) {
    const $vmEditContract = new Vue(editContract)
  }

  const app = new Vue({
    el: '#app'
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
})
