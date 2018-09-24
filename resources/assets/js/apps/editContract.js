import Vue from 'vue'
import axios from 'axios'

export default {
  el: '#edit__contract',
  props: ['sale_contract'],
  data: {
    contract: {
      mortgage_credit: '',
    }
  },
  computed: {
    isInfonavit() {
      return this.contract.mortgage_credit === 'INFONAVIT'
    },
    isFovissste() {
      return this.contract.mortgage_credit === 'FOVISSSTE'
    },
    isCofinavit() {
      return this.contract.mortgage_credit === 'COFINAVIT'
    },
    isBanking() {
      return this.contract.mortgage_credit === 'Bancario'
    },
    isAllies() {
      return this.contract.mortgage_credit === 'Aliados'
    },
  },
  methods: {
    onSubmit() {

    }
  },
  created() {
  },
  beforeMounted() {},
  mounted() {
    console.log(sale_contract);
  }
}
