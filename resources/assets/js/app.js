
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
Vue.component('Client', require('./components/Client.vue'))

const clientRoot = document.getElementById('client-info') || null

if (clientRoot !== null) {
  const ClientInfo = new Vue({
    el: '#client-info',
    data: {
      clientPhoneOne: '',
      clientPhoneTwo: '',
      clientEmail: '',
      loading: false
    },
    computed: {
      hasClient: function () {
        return (
          this.clientPhoneOne.length !== 0 ||
          this.clientPhoneTwo.length !== 0 ||
          this.clientEmail.length !== 0
        )
      }
    },
    methods: {
      getClientInfo: function () {
        const clientId = document.getElementById('client_id').value
        const self = this
        self.loading = true

        if (clientId !== '') {
          const url = process.env.NODE_ENV !== 'production'
            ? `http://45.77.197.22/clients/show/${clientId}`
            : `https://local.rolveinmobiliaria.com/clients/show/${clientId}`

          const inicialization = {
            method: 'GET',
            mode: 'cors',
            cache: 'default'
          }

          fetch(url, inicialization)
            .then(response => response.json())
            .then(function (json) {
              self.loading = false
              self.clientPhoneOne = json.phone_1 || ''
              self.clientPhoneTwo = json.phone_2 || ''
              self.clientEmail = json.email || ''
            })
        } else {
          self.loading = false
          self.clientPhoneOne = ''
          self.clientPhoneTwo = ''
          self.clientEmail = ''
        }
      }
    },
    mounted: function () {
      this.getClientInfo()
    }
  })
}
