import Vuex, { mapState, mapGetters, mapActions } from 'vuex'

Vue.use(Vuex)

let store = new Vuex.Store({
  state: {
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
    },
    loading: false,
    empty: true,
  },
  getters: {
    sellerIsComplete (state) {
      return (
        state.sale.seller.deed ||
        state.sale.seller.water ||
        state.sale.seller.predial ||
        state.sale.seller.light ||
        state.sale.seller.birth_certificate ||
        state.sale.seller.ID ||
        state.sale.seller.CURP !== '' ||
        state.sale.seller.RFC !== '' ||
        state.sale.seller.account_status ||
        state.sale.seller.email ||
        state.sale.seller.phone ||
        state.sale.seller.civil_status !== ''
      )
    },
    hasClient (state) {
      return (
        state.client.phoneOne.length !== 0 ||
        state.client.phoneTwo.length !== 0 ||
        state.client.emailOne.length !== 0 ||
        state.client.emailTwo.length !== 0
      )
    },
    hasExpedient (state) {
      return (
        state.client.reference.length !== 0
      )
    },
    getFullName (state) {
      return `${state.client.firstName} ${state.client.lastName}`
    },
    getExpedient (state) {
      return `${state.client.expedient.key}/${state.client.expedient.number}/${state.client.expedient.year}`
    }
  },
  mutations: {
    updateLoading (state, payload) {
      state.loading = payload
    },
    updateEmpty (state, payload) {
      state.empty = payload
    },
    updateClientID (state, payload) {
      state.client.id = payload
    },
    updateClientFirstName (state, payload) {
      state.client.firstName = payload
    },
    updateClientLastName (state, payload) {
      state.client.lastName = payload
    },
    updateClientExpedientKey (state, payload) {
      state.client.expedient.key = payload
    },
    updateClientExpedientNumber (state, payload) {
      state.client.expedient.number = payload
    },
    updateClientExpedientYear (state, payload) {
      state.client.expedient.year = payload
    },
    updateClientPhoneOne (state, payload) {
      state.client.phoneOne = payload
    },
    updateClientPhoneTwo (state, payload) {
      state.client.phoneTwo = payload
    },
    updateClientBusiness (state, payload) {
      state.client.business = payload
    },
    updateClientEmailOne (state, payload) {
      state.client.emailOne = payload
    },
    updateClientEmailTwo (state, payload) {
      state.client.emailTwo = payload
    },
    updateClientReference (state, payload) {
      state.client.reference = payload
    },
    updateSellerDeed (state, payload) {
      state.sale.seller.deed = payload
    },
    updateSellerWater (state, payload) {
      state.sale.seller.water = payload
    },
    updateSellerPredial (state, payload) {
      state.sale.seller.predial = payload
    },
    updateSellerLight (state, payload) {
      state.sale.seller.light = payload
    },
    updateSellerBirthCertificate (state, payload) {
      state.sale.seller.birth_certificate = payload
    },
    updateSellerID (state, payload) {
      state.sale.seller.ID = payload
    },
    updateSellerCURP (state, payload) {
      state.sale.seller.CURP = payload
    },
    updateSellerRFC (state, payload) {
      state.sale.seller.RFC = payload
    },
    updateSellerAccountStatus (state, payload) {
      state.sale.seller.account_status = payload
    },
    updateSellerEmail (state, payload) {
      state.sale.seller.email = payload
    },
    updateSellerPhone (state, payload) {
      state.sale.seller.phone = payload
    },
    updateSellerCivilStatus (state, payload) {
      state.sale.seller.civil_status = payload
    }
  },
  actions: {
    getClientInfo (context, payload) {
      const clientId = context.state.client.id
      context.commit('updateLoading', true)

      if (clientId.trim().length !== 0 && clientId !== '') {
        const uri = `/api/v1/client/show/${clientId}`

        const inicialization = {
          withCredentials: false
        }

        axios.get(uri, inicialization)
          .then(response => response.data[0])
          .catch(error => console.log(error))
          .then(response => {
            console.log('Response: ' + response);
            context.commit('updateLoading', false)
            context.commit('updateClientID', response.id || '')
            context.commit('updateClientFirstName', response.first_name || '')
            context.commit('updateClientLastName', response.last_name || '')
            context.commit('updateClientPhoneOne', response.phone_1 || '')
            context.commit('updateClientPhoneTwo', response.phone_2 || '')
            context.commit('updateClientBusiness', response.business || '')
            context.commit('updateClientEmailOne', response.email_1 || '')
            context.commit('updateClientEmailTwo', response.email_2 || '')
            context.commit('updateClientReference', response.reference || '')
            context.commit('updateEmpty', false)
          })
          .catch(error => console.log(error))
      } else {
        context.commit('updateLoading', false)
        context.commit('updateClientID', '')
        context.commit('updateClientFirstName', '')
        context.commit('updateClientLastName', '')
        context.commit('updateClientPhoneOne', '')
        context.commit('updateClientPhoneTwo', '')
        context.commit('updateClientEmailOne', '')
        context.commit('updateClientEmailTwo', '')
        context.commit('updateEmpty', false)
      }
    },
    getExpedientInfo (context, payload) {
      const expedientId = payload
      context.commit('updateLoading', true)

      if (expedientId !== '') {
        const uri = `/api/v1/internal_expedient/show/${expedientId}`

        const inicialization = {
          withCredentials: false
        }

        axios.get(uri, inicialization)
          .then(response => response.data[0])
          .catch(error => console.log(error))
          .then(response => {
            context.commit('updateClientID', response.id || '')
            context.commit('updateClientExpedientKey', response.expedient_key || '')
            context.commit('updateClientExpedientNumber', response.expedient_number || '')
            context.commit('updateClientExpedientYear', response.expedient_year || '')
            context.commit('updateClientFirstName', response.client.first_name || '')
            context.commit('updateClientLastName', response.client.last_name || '')
            context.commit('updateClientPhoneOne', response.client.phone_1 || '')
            context.commit('updateClientPhoneTwo', response.client.phone_2 || '')
            context.commit('updateClientBusiness', response.client.business || '')
            context.commit('updateClientEmailOne', response.client.email_1 || '')
            context.commit('updateClientEmailTwo', response.client.email_2 || '')
            context.commit('updateClientReference', response.client.reference || '')
            context.commit('updateLoading', false)
            context.commit('updateEmpty', false)
          })
          .catch(error => console.log(error))
      } else {
        context.commit('updateClientID', '')
        context.commit('updateClientFirstName', '')
        context.commit('updateClientLastName', '')
        context.commit('updateClientPhoneOne', '')
        context.commit('updateClientPhoneTwo', '')
        context.commit('updateClientEmailOne', '')
        context.commit('updateClientEmailTwo', '')
        context.commit('updateLoading', false)
        context.commit('updateEmpty', true)
      }
    }
  }
})

export default store
