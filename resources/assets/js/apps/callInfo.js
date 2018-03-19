export default {
  el: '#call-info',
  data: {
    clientId: '',
    clientFirstName: '',
    clientLastName: '',
    clientExpedient: '',
    clientPhoneOne: '',
    clientPhoneTwo: '',
    clientBusiness: '',
    clientEmailOne: '',
    clientEmailTwo: '',
    clientReference: '',
    loading: false,
    empty: true
  },
  computed: {
    hasClient: function () {
      return (
        this.clientPhoneOne.length !== 0 ||
        this.clientPhoneTwo.length !== 0 ||
        this.clientEmailOne.length !== 0 ||
        this.clientEmailTwo.length !== 0
      )
    },
    hasExpedient: function () {
      return (
        this.clientReference.length !== 0
      )
    },
    fullName: function () {
      return this.clientFirstName + ' ' + this.clientLastName
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
              this.loading = false
              this.clientId = response.id || ''
              this.clientFirstName = response.first_name || ''
              this.clientLastName = response.last_name || ''
              this.clientPhoneOne = response.phone_1 || ''
              this.clientPhoneTwo = response.phone_2 || ''
              this.clientBusiness = response.business || ''
              this.clientEmailOne = response.email_1 || ''
              this.clientEmailTwo = response.email_2 || ''
              this.clientReference = response.reference || ''
              this.empty = false
            })
      } else {
        this.loading = false
        this.clientId = ''
        this.clientFirstName = ''
        this.clientLastName = ''
        this.clientPhoneOne = ''
        this.clientPhoneTwo = ''
        this.clientEmailOne = ''
        this.clientEmailTwo = ''
        this.empty = false
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
            this.clientId = response.id || ''
            this.clientExpedient = response.expedient || ''
            this.clientFirstName = response.client.first_name || ''
            this.clientLastName = response.client.last_name || ''
            this.clientPhoneOne = response.client.phone_1 || ''
            this.clientPhoneTwo = response.client.phone_2 || ''
            this.clientBusiness = response.client.business || ''
            this.clientEmailOne = response.client.email_1 || ''
            this.clientEmailTwo = response.client.email_2 || ''
            this.clientReference = response.client.reference || ''
            this.loading = false
            this.empty = false
          })
      } else {
        this.loading = false
        this.clientId = ''
        this.clientFirstName = ''
        this.clientLastName = ''
        this.clientPhoneOne = ''
        this.clientPhoneTwo = ''
        this.clientEmailOne = ''
        this.clientEmailTwo = ''
        this.empty = false
      }
    }
  },
  created: function () {
    const withExpedient = document.getElementById('internal_expedient_id').value

    if (withExpedient !== '') {
      this.empty = false
    }
  },
  mounted: function () {
    if (this.empty === false) {
      this.getExpedientInfo()
    }
  }
}
