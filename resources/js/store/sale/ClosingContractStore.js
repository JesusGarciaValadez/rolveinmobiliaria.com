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
      closingContract: {
        exclusivity_contract: 'mm-dd-aaaa',
        commercial_valuation: 'mm-dd-aaaa',
        publication: 'mm-dd-aaaa',
        data_sheet: '',
        observations: ''
      }
    },
    loading: false,
    empty: true
  },
  getters: {
    closingContractIsComplete (state) {
      return (
        state.sale.closingContract.exclusivity_contract ||
        state.sale.closingContract.commercial_valuation !== '' ||
        state.sale.closingContract.publication !== '' ||
        state.sale.closingContract.data_sheet !== '' ||
        state.sale.closingContract.observations !== ''
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
    updateClosingContractExclusivityContract (state, payload) {
      state.sale.closingContract.exclusivity_contract = payload
    },
    updateClosingContractCommercialValuation (state, payload) {
      state.sale.closingContract.commercial_valuation = payload
    },
    updateClosingContractPublication (state, payload) {
      state.sale.closingContract.publication = payload
    },
    updateClosingContractDataSheet (state, payload) {
      state.sale.closingContract.data_sheet = payload
    },
    updateClosingContractObservations (state, payload) {
      state.sale.closingContract.observations = payload
    },
  },
  actions: {
    getClientInfo (context, payload) {
      const clientId = context.state.client.id
      context.commit('updateLoading', true)

      if (clientId.trim().length !== 0 && clientId !== '') {
        const uri = `/api/clients/show/${clientId}`

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
        const uri = `/api/internal_expedients/show/${expedientId}`

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
