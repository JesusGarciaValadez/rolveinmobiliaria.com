import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapState, mapGetters, mapActions } from 'vuex'
import store from '../store/sale/SignatureStore'
import Spinner from '../components/Spinner'
import Expedient from '../components/Expedient'
import Client from '../components/Client'

export default {
  el: '#edit__signature',
  store,
  components: {
    Spinner,
    Expedient,
    Client
  },
  computed: {
    ...mapState([
      'client',
      'sale',
      'loading',
      'empty'
    ]),
    ...mapGetters([
      'closingContractIsComplete',
      'hasClient',
      'hasExpedient',
      'getFullName',
      'getExpedient'
    ]),
  },
  methods: {
    getClientInfo() {
      this.$store.dispatch('getClientInfo')
      console.log(this.client.expedient)
    },
    getExpedientInfo() {
      const payload = document.getElementById('internal_expedient_id').value
      this.$store.dispatch('getExpedientInfo', payload)
    },
    onSubmit(event) {
      if (this.$store.state.sellerIsComplete) {
        let form = document.getElementById('edit__closing-contract')
        form.submit()
      }
      return false
    },
    setClosingContractExclusitivyContract(event) {
      this.$store.commit('updateClosingContractExclusivityContract', document.getElementById('SCC_exclusivity_contract').value)
    },
    setClosingContractCommercialValuation(event) {
      this.$store.commit('updateClosingContractCommercialValuation', document.getElementById('SCC_commercial_valuation').value)
    },
    setClosingContractPublication(event) {
      this.$store.commit('updateClosingContractPublication', document.getElementById('SCC_publication').value)
    },
    setClosingContractDataSheet(event) {
      this.$store.commit('updateClosingContractDataSheet', document.getElementById('SCC_data_sheet').value)
    },
    setClosingContractObservations(event) {
      this.$store.commit('updateClosingContractObservations', document.getElementById('SCC_closing_contract_observations').value)
    }
  },
  created() {
    this.setClosingContractExclusitivyContract()
    this.setClosingContractCommercialValuation()
    this.setClosingContractPublication()
    this.setClosingContractDataSheet()
    this.setClosingContractObservations()
  },
  beforeMounted() {
    this.getClientInfo()
  },
  mounted() {

  }
}
