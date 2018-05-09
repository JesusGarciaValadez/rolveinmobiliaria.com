import callInfo from './apps/callInfo'
import callFilter from './apps/callFilter'
import salesCreation from './apps/salesCreation'
import salesEdit from './apps/salesEdit'
import newExpedient from './components/newExpedient'

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

const callFilterRoot = document.getElementById('call-filter') || null
const callInfoRoot = document.getElementById('call-info') || null
const salesCreationRoot = document.getElementById('sale-create') || null
const salesEditRoot = document.getElementById('sale-edit') || null
const newExpedientRoot = document.getElementById('newExpedient') || null

if (callInfoRoot !== null) {
  const $vmCall = new Vue(callInfo)
}

if (callFilterRoot) {
  const $vmCallFilter = new Vue(callFilter)
}

if (salesCreationRoot !== null) {
  const $vmSalesCreation = new Vue(salesCreation)
}

if (salesEditRoot !== null) {
  const $vmSalesEdit = new Vue(salesEdit)
}

if (newExpedientRoot !== null) {
  const $vmNewExpedient = new Vue(newExpedient)
}
