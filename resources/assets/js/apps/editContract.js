import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapState, mapGetters, mapActions } from 'vuex'
import store from '../store/sale/ContractStore'

Vue.use(Vuex)

export default {
  el: '#edit__contract',
  store,
  computed: {
    ...mapState([
      'sale',
      'empty'
    ]),
    ...mapGetters([
      'contractIsComplete',
    ]),
  },
  methods: {
    onSubmit(event) {
      if (this.$store.state.contractIsComplete) {
        let form = document.getElementById('edit__contract')
        form.submit()
      }
      return false
    },
    setContractExclusitivyContract(event) {
      this.$store.commit('updateContractExclusivityContract', document.getElementById('SCC_exclusivity_contract').value)
    },
    setContractCommercialValuation(event) {
      this.$store.commit('updateContractCommercialValuation', document.getElementById('SCC_commercial_valuation').value)
    },
    setContractPublication(event) {
      this.$store.commit('updateContractPublication', document.getElementById('SCC_publication').value)
    },
    setContractDataSheet(event) {
      this.$store.commit('updateContractDataSheet', document.getElementById('SCC_data_sheet').value)
    },
    setContractObservations(event) {
      this.$store.commit('updateContractObservations', document.getElementById('SCC_closing_contract_observations').value)
    }
  },
  created() {
    this.setContractExclusitivyContract()
    this.setContractCommercialValuation()
    this.setContractPublication()
    this.setContractDataSheet()
    this.setContractObservations()
  },
  beforeMounted() {},
  mounted() {

  }
}
