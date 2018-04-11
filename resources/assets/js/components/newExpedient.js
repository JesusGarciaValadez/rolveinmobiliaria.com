import Vue from 'vue'
import axios from 'axios'
import spinner from './Spinner'
import client from './Client'

Vue.component('spinner', spinner)
Vue.component('client', client)

export default {
  el: '#newExpedient',
  data: {
    client: {
      id: '',
      firstName: '',
      lastName: '',
      expedient: {
        key: '',
        number: '',
        year: ''
      },
      phoneOne: '',
      phoneTwo: '',
      business: '',
      emailOne: '',
      emailTwo: '',
      reference: ''
    },
    loading: false,
    empty: true
  },
  children: ['spinner', 'client'],
  computed: {
    hasClient: function () {
      return (
        this.client.phoneOne.length !== 0 ||
        this.client.phoneTwo.length !== 0 ||
        this.client.emailOne.length !== 0 ||
        this.client.emailTwo.length !== 0
      )
    },
    hasExpedient: function () {
      return (
        this.client.reference.length !== 0
      )
    },
    fullName: function () {
      return this.client.firstName + ' ' + this.client.lastName
    },
    expedient: function () {
      return `${this.client.expedient.key}/${this.client.expedient.number}/${this.client.expedient.year}`
    }
  },
  methods: {
    getClientInfo: function () {
      const clientId = document.getElementById('client_id').value
      this.loading = true

      if (clientId !== '') {
        const uri = `/api/clients/show/${clientId}`

        const inicialization = {
          withCredentials: false
        }

        axios.get(uri, inicialization)
          .then(response => response.data[0])
          .catch(error => console.log(error))
          .then(response => {
            this.loading = false
            this.client.id = response.id || ''
            this.client.firstName = response.first_name || ''
            this.client.lastName = response.last_name || ''
            this.client.phoneOne = response.phone_1 || ''
            this.client.phoneTwo = response.phone_2 || ''
            this.client.business = response.business || ''
            this.client.emailOne = response.email_1 || ''
            this.client.emailTwo = response.email_2 || ''
            this.client.reference = response.reference || ''
            this.empty = false
          })
      } else {
        this.loading = false
        this.client.id = ''
        this.client.firstName = ''
        this.client.lastName = ''
        this.client.phoneOne = ''
        this.client.phoneTwo = ''
        this.client.emailOne = ''
        this.client.emailTwo = ''
        this.empty = false
      }
    },
  },
  created: function () {},
  mounted: function () {}
}
