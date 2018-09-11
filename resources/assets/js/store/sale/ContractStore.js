import Vuex, { mapState, mapGetters, mapActions } from 'vuex'

Vue.use(Vuex)

let store = new Vuex.Store({
  state: {
    sale: {
      contract: {
        exclusivity_contract: 'mm-dd-aaaa',
        commercial_valuation: 'mm-dd-aaaa',
        publication: 'mm-dd-aaaa',
        data_sheet: '',
        observations: ''
      }
    },
    empty: true
  },
  getters: {
    contractIsComplete (state) {
      return (
        state.sale.contract.exclusivity_contract ||
        state.sale.contract.commercial_valuation !== '' ||
        state.sale.contract.publication !== '' ||
        state.sale.contract.data_sheet !== '' ||
        state.sale.contract.observations !== ''
      )
    },
  },
  mutations: {
    updateEmpty (state, payload) {
      state.empty = payload
    },
    updateContractExclusivityContract (state, payload) {
      state.sale.contract.exclusivity_contract = payload
    },
    updateContractCommercialValuation (state, payload) {
      state.sale.contract.commercial_valuation = payload
    },
    updateContractPublication (state, payload) {
      state.sale.contract.publication = payload
    },
    updateContractDataSheet (state, payload) {
      state.sale.contract.data_sheet = payload
    },
    updateContractObservations (state, payload) {
      state.sale.contract.observations = payload
    },
  },
  actions: {}
})

export default store
