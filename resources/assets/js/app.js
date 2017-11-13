
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
      clientBusiness: '',
      clientEmail: '',
      clientReference: '',
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
          const environment = process.env.NODE_ENV
          const uri = `/api/clients/show/${clientId}`
          const localUrl = `http://local.rolveinmobiliaria.com${uri}`
          const productionUrl = `http://45.77.197.22${uri}`

          const url = (environment != 'production')
            ? localUrl
            : productionUrl

          const inicialization = {
            withCredentials: false
          }

          axios.get(url, inicialization)
            .then(response => response.data[0])
            .catch(error => console.log(error))
            .then(response => {
              self.loading = false
              self.clientPhoneOne = response.phone_1 || ''
              self.clientPhoneTwo = response.phone_2 || ''
              self.clientBusiness = response.business || ''
              self.clientEmail = response.email || ''
              self.clientReference = response.reference || ''
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
