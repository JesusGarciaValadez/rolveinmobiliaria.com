import callInfo from './apps/callInfo'
import clientFilter from './apps/clientFilter'
import createSeller from './apps/createSeller'
import editSeller from './apps/editSeller'
import newExpedient from './components/newExpedient'

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

const clientFilterRoot = document.getElementById('client__filter') || null
const callInfoRoot = document.getElementById('call__info') || null
const createSellerRoot = document.getElementById('create__seller') || null
const editSellerRoot = document.getElementById('edit__seller') || null
const newExpedientRoot = document.getElementById('new__expedient') || null

if (callInfoRoot !== null) {
  const $vmCall = new Vue(callInfo)
}

if (clientFilterRoot) {
  const $vmClientFilter = new Vue(clientFilter)
}

if (createSellerRoot !== null) {
  const $vmCreateSeller = new Vue(createSeller)
}

if (editSellerRoot !== null) {
  const $vmCreateEdit = new Vue(editSeller)
}

if (newExpedientRoot !== null) {
  const $vmNewExpedient = new Vue(newExpedient)
}
