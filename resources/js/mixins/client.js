export default {
  data() {
    return {
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
      clients: null,
      loading: false,
      empty: true,
    }
  },
  computed: {
    hasClient() {
      return (
        this.client.phoneOne.length !== 0 ||
        this.client.phoneTwo.length !== 0 ||
        this.client.emailOne.length !== 0 ||
        this.client.emailTwo.length !== 0
      )
    },
    hasExpedient() {
      return (
        this.client.expedient.key !== '' &&
        this.client.expedient.number !== '' &&
        this.client.expedient.year !== ''
      )
    },
    fullName() {
      return `${this.client.firstName} ${this.client.lastName}`
    },
    expedientComposed() {
      return `${this.client.expedient.key}/${this.client.expedient.number}/${this.client.expedient.year}`
    }
  },
  methods: {
    getClientInfo() {
      this.loading = true
      const clientId = document.getElementById('client_id').value

      if (clientId !== '') {
        const uri = `/api/v1/client/show/${clientId}`

        const inicialization = {
          withCredentials: false
        }

        axios.get(uri, inicialization)
          .then(response => response.data[0])
          .catch(error => console.log(error))
          .then(response => {
            const { id, first_name, last_name, phone_1, phone_2, business, email_1, email_2, reference } = response
            this.client.id = id || ''
            this.client.firstName = first_name || ''
            this.client.lastName = last_name || ''
            this.client.phoneOne = phone_1 || ''
            this.client.phoneTwo = phone_2 || ''
            this.client.business = business || ''
            this.client.emailOne = email_1 || ''
            this.client.emailTwo = email_2 || ''
            this.client.reference = reference || ''
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
    getExpedientInfo(id = null, event) {
      const expedientId = id || document.getElementById('internal_expedient_id').value
      this.loading = true

      if (expedientId !== '') {
        const uri = `/api/v1/internal_expedient/show/${expedientId}`

        const inicialization = {
          withCredentials: false
        }

        axios.get(uri, inicialization)
          .then(response => response.data[0])
          .catch(error => console.log(error))
          .then(response => {
            const { id, expedient_key, expedient_number, expedient_year, client } = response
            const { first_name, last_name, phone_1, phone_2, business, email_1, email_2, reference } = client
            this.client.id = id || ''
            this.client.firstName = first_name || ''
            this.client.lastName = last_name || ''
            this.client.expedient.key = expedient_key || ''
            this.client.expedient.number = expedient_number || ''
            this.client.expedient.year = expedient_year || ''
            this.client.phoneOne = phone_1 || ''
            this.client.phoneTwo = phone_2 || ''
            this.client.business = business || ''
            this.client.emailOne = email_1 || ''
            this.client.emailTwo = email_2 || ''
            this.client.reference = reference || ''
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
    },
    receiveInitialClient() {
      if (this.initialClient) {
        const { id, firstName, lastName, expedient, phoneOne, phoneTwo, business, emailOne, emailTwo, reference } = this.initialClient
        const { key, number, year } = expedient

        this.client.id = id
        this.client.firstName = firstName
        this.client.lastName = lastName
        this.client.expedient.key = key
        this.client.expedient.number = number
        this.client.expedient.yea = year
        this.client.phoneOne = phoneOne
        this.client.phoneTwo = phoneTwo
        this.client.business = business
        this.client.emailOne = emailOne
        this.client.emailTwo = emailTwo
        this.client.reference = reference
      }
    },
  },
  mounted() {
   if (typeof(this.initialClients) === 'string') {
      this.clients = JSON.parse(this.initialClients)
    }
  },
  beforeUpdate() {
    this.receiveInitialClient()
  },
}
