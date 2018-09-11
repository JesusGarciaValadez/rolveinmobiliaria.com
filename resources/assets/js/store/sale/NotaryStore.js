import Vuex, { mapState, mapGetters, mapActions } from 'vuex'

Vue.use(Vuex)

let store = new Vuex.Store({
  state: {
    sale: {
      notary: {
        federal_entity: '',
        notaries_office: '0',
        date_freedom_of_lien_certificate: 'mm-dd-aaaa hh:mm',
        observations_freedom_of_lien_certificate: '',
        zoning: false,
        water_no_due_constants: false,
        non_debit_proof_of_property: false,
        certificate_of_improvement: false,
        key_and_cadastral_value: false,
        seller_documents: false,
        buyer_documents: false,
        activation_documents_for_the_mortgage_loan: false
      }
    },
    empty: true
  },
  getters: {
    notaryIsComplete (state) {
      return (
        state.sale.notary.federal_entity ||
        state.sale.notary.notaries_office ||
        state.sale.notary.date_freedom_of_lien_certificate ||
        state.sale.notary.observations_freedom_of_lien_certificate ||
        state.sale.notary.zoning ||
        state.sale.notary.water_no_due_constants ||
        state.sale.notary.non_debit_proof_of_property ||
        state.sale.notary.certificate_of_improvement ||
        state.sale.notary.key_and_cadastral_value ||
        state.sale.notary.seller_documents ||
        state.sale.notary.buyer_documents ||
        state.sale.notary.activation_documents_for_the_mortgage_loan
      )
    }
  },
  mutations: {
    updateEmpty (state, payload) {
      state.empty = payload
    },
    updateNotaryNotariesOffice (state, payload) {
      state.sale.notary.notaries_office = payload
    },
    updateNotaryFederalEntity (state, payload) {
      state.sale.notary.federal_entity = payload
    },
    updateNotaryDateFreedomOfLienCertificate (state, payload) {
      state.sale.notary.date_freedom_of_lien_certificate = payload
    },
    updateNotaryObservationsFreedomOfLienCertificate (state, payload) {
      state.sale.notary.observations_freedom_of_lien_certificate = payload
    },
    updateNotaryZoning (state, payload) {
      state.sale.notary.zoning = payload
    },
    updateNotaryWaterNoDueConstants (state, payload) {
      state.sale.notary.water_no_due_constants = payload
    },
    updateNotaryNonDebitProofOfProperty (state, payload) {
      state.sale.notary.non_debit_proof_of_property = payload
    },
    updateNotaryCertificateOfImprovement (state, payload) {
      state.sale.notary.certificate_of_improvement = payload
    },
    updateNotaryKeyAndCadastralValue (state, payload) {
      state.sale.notary.key_and_cadastral_value = payload
    },
    updateNotarySellerDocuments (state, payload) {
      state.sale.notary.seller_documents = payload
    },
    updateNotaryBuyerDocuments (state, payload) {
      state.sale.notary.buyer_documents = payload
    },
    updateNotaryActivationDocumentsForTheMortgageLoan (state, payload) {
      state.sale.notary.activation_documents_for_the_mortgage_loan = payload
    },
  },
  actions: {}
})

export default store
