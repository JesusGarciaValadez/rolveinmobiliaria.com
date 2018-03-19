import callInfo from './apps/callInfo'
import salesCreation from './apps/salesCreation'
import callFilter from './apps/callFilter'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

const Vue = window.Vue

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Spinner', require('./components/Spinner.vue'))
Vue.component('Expedient', require('./components/Expedient.vue'))
Vue.component('Client', require('./components/Client.vue'))

const callFilterRoot = document.getElementById('call-filter') || null
const callInfoRoot = document.getElementById('call-info') || null
const salesRoot = document.getElementById('purchase-sale') || null

if (callInfoRoot !== null) {
  const $vmCall = new Vue(callInfo)
}

if (salesRoot !== null) {
  const $vmSales = new Vue(salesCreation)
}

if (callFilterRoot) {
  const $vmCallFilter = new Vue(callFilter)
}
