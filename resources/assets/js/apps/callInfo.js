import axios from 'axios'

export default {
  el: '#call__info',
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
  children: ['spinner', 'expedient', 'client'],
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
      this.loading = true
      const clientId = document.getElementById('client_id').value

      if (clientId !== '') {
        const uri = `/api/clients/show/${clientId}`

        const inicialization = {
          withCredentials: false
        }

        axios.get(uri, inicialization)
          .then(response => response.data[0])
          .catch(error => console.log(error))
          .then(response => {
            this.client.id = response.id || ''
            this.client.firstName = response.first_name || ''
            this.client.lastName = response.last_name || ''
            this.client.phoneOne = response.phone_1 || ''
            this.client.phoneTwo = response.phone_2 || ''
            this.client.business = response.business || ''
            this.client.emailOne = response.email_1 || ''
            this.client.emailTwo = response.email_2 || ''
            this.client.reference = response.reference || ''
            this.loading = false
            this.empty = false
          })
      } else {
        this.client.id = ''
        this.client.firstName = ''
        this.client.lastName = ''
        this.client.phoneOne = ''
        this.client.phoneTwo = ''
        this.client.emailOne = ''
        this.client.emailTwo = ''
        this.loading = false
        this.empty = true
      }
    },
    getExpedientInfo: function () {
      const expedientId = document.getElementById('internal_expedient_id').value
      this.loading = true

      if (expedientId !== '') {
        const uri = `/api/internal_expedients/show/${expedientId}`

        const inicialization = {
          withCredentials: false
        }

        axios.get(uri, inicialization)
          .then(response => response.data[0])
          .catch(error => console.log(error))
          .then(response => {
            this.client.id = response.id || ''
            this.client.expedient.key = response.expedient_key || ''
            this.client.expedient.number = response.expedient_number || ''
            this.client.expedient.year = response.expedient_year || ''
            this.client.firstName = response.client.first_name || ''
            this.client.lastName = response.client.last_name || ''
            this.client.phoneOne = response.client.phone_1 || ''
            this.client.phoneTwo = response.client.phone_2 || ''
            this.client.business = response.client.business || ''
            this.client.emailOne = response.client.email_1 || ''
            this.client.emailTwo = response.client.email_2 || ''
            this.client.reference = response.client.reference || ''
            this.loading = false
            this.empty = false
          })
      } else {
        this.client.id = ''
        this.client.firstName = ''
        this.client.lastName = ''
        this.client.phoneOne = ''
        this.client.phoneTwo = ''
        this.client.emailOne = ''
        this.client.emailTwo = ''
        this.client.reference = ''
        this.loading = false
        this.empty = true
      }
    }
  },
  created: function () {},
  mounted: function () {
    const withExpedient = document.getElementById('internal_expedient_id').value

    if (withExpedient !== '') {
      this.empty = false
    }

    if (this.empty === false) {
      this.getExpedientInfo()
    }
  }
}
