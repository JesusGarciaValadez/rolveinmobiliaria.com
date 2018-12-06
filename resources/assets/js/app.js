import createSeller from './apps/createSeller'
import editSeller from './apps/editSeller'
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
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('expedient', require('./components/Expedient'))
Vue.component('client', require('./components/Client'))
Vue.component('spinner', require('./components/Spinner'))

Vue.component('modal-expedient', require('./components/modal/expedient'))
Vue.component('modal-client', require('./components/modal/client'))
Vue.component('select-internal-expedient', require('./components/select-internal-expedient'))

Vue.component('client-filter', require('./components/client/filter'))

const createSellerRoot = document.getElementById('create__seller') || null
const editSellerRoot = document.getElementById('edit__seller') || null
const editClosingContractRoot = document.getElementById('edit__closing-contract') || null
const editContractRoot = document.getElementById('edit__contract') || null

if (createSellerRoot !== null) {
  const $vmCreateSeller = new Vue(createSeller)
}

if (editSellerRoot !== null) {
  const $vmEditSeller = new Vue(editSeller)
}

if (editClosingContractRoot !== null) {
  const $vmEditClosingContract = new Vue(editClosingContract)
}

if (editContractRoot !== null) {
  const $vmEditContract = new Vue(editContract)
}

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

  const app = new Vue({
    el: '#app'
  })

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
})
