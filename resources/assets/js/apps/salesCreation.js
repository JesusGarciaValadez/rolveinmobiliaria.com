import Vue from 'vue'
import axios from 'axios'
import spinner from '../components/Spinner'
import expedient from '../components/Expedient'
import client from '../components/Client'

Vue.component('spinner', spinner)
Vue.component('expedient', expedient)
Vue.component('client', client)

export default {
  el: '#sale-create',
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
    empty: true,
    sale: {
      seller: {
        deed: false,
        water: false,
        predial: false,
        light: false,
        birth_certificate: false,
        ID: false,
        CURP: '',
        RFC: '',
        account_status: false,
        email: false,
        phone: false,
        civil_status: ''
      },
      closingContract: {
        exclusivity_contract: '',
        commercial_valuation: '',
        publication: '',
        data_sheet: '',
        observations: ''
      }
    }
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
    },
    sellersIsComplete: function () {
      return (
        this.sale.seller.deed ||
        this.sale.seller.water ||
        this.sale.seller.predial ||
        this.sale.seller.light ||
        this.sale.seller.birth_certificate ||
        this.sale.seller.ID ||
        this.sale.seller.CURP !== '' ||
        this.sale.seller.RFC !== '' ||
        this.sale.seller.account_status ||
        this.sale.seller.email ||
        this.sale.seller.phone ||
        this.sale.seller.civil_status !== ''
      )
    },
    closingContractIsComplete: function () {
      return (
        this.sale.closingContract.exclusivity_contract.length !== 0 ||
        this.sale.closingContract.commercial_valuation.length !== 0 ||
        this.sale.closingContract.publication.length !== 0 ||
        this.sale.closingContract.data_sheet.length !== 0 ||
        this.sale.closingContract.observations.length !== 0
      )
    },
    saleIsComplete: function () {
      return (this.sellersIsComplete || this.sale.closingContractIsComplete)
    },
    showClosingContract: function () {
      return this.sellersIsComplete
    }
  },
  methods: {
    getClientInfo: function () {
      const clientId = this.client.id
      this.loading = true

      if (clientId.trim().length !== 0 && clientId !== '') {
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
        this.loading = false
        this.empty = true
      }
    },
    onUpload: function (event) {
      const fileUpload = event.currentTarget

      if (
        fileUpload.name === 'SCC_data_sheet' &&
        fileUpload.value !== ''
      ) {
        this.sale.closingContract.data_sheet = true
      } else {
        this.sale.closingContract.data_sheet = false
      }
    },
    onTextarea: function (event) {
      const textarea = event.currentTarget

      if (
        textarea.name === 'SCC_closing_contract_observations' &&
        textarea.value !== ''
      ) {
        this.sale.closingContract.observations = true
      } else {
        this.sale.closingContract.observations = false
      }
    },
    onSubmit: function (event) {
      if (this.sellerIsComplete && this.closingContractIsComplete) {
        let form = document.getElementById('sale-create')
        form.submit()
      }
      return false
    },
    getID: function (element) {
      return document.getElementById(element)
    },
    setSellers: function () {
      this.sale.seller.deed = this.getID('SD_deed').checked
      this.sale.seller.water = this.getID('SD_water').checked
      this.sale.seller.predial = this.getID('SD_predial').checked
      this.sale.seller.light = this.getID('SD_light').checked
      this.sale.seller.birth_certificate = this.getID('SD_birth_certificate').checked
      this.sale.seller.ID = this.getID('SD_ID').checked
      this.sale.seller.CURP = this.getID('SD_CURP').value
      this.sale.seller.RFC = this.getID('SD_RFC').value
      this.sale.seller.account_status = this.getID('SD_account_status').checked
      this.sale.seller.email = this.getID('SD_email').checked
      this.sale.seller.phone = this.getID('SD_phone').checked
      this.sale.seller.civil_status = this.getID('SD_civil_status').value
    },
    setClosingContract: function () {
      this.sale.closingContract.exclusivity_contract = this.getID('SCC_exclusivity_contract').value || ''
      this.sale.closingContract.commercial_valuation = this.getID('SCC_commercial_valuation').value || ''
      this.sale.closingContract.publication = this.getID('SCC_publication').value || ''
      this.sale.closingContract.data_sheet = this.getID('SCC_data_sheet').value || null
      this.sale.closingContract.observations = this.getID('SCC_closing_contract_observations').value || ''
    }
  },
  created: function () {},
  mounted: function () {
    this.setSellers()
    this.setClosingContract()
  }
}
