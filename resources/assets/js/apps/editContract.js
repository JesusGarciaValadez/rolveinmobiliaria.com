import Vue from 'vue'
import axios from 'axios'

export default {
  el: '#edit__contract',
  props: ['initials'],
  data: {
    contract: {
      general_buyer: '',
      purchase_agreements: '',
      tax_assessment: '',
      notary_checklist: '',
      notary_file: '',
      mortgage_credit: '',
      infonavit: {
        certified_birth_certificate: '',
        official_ID: '',
        curp: '',
        rfc: '',
        credit_simulator: '',
        credit_application: '',
        tax_valuation: '',
        bank_statement: '',
        workshop_knowing_how_to_decide: '',
        retention_sheet: '',
        credit_activation: '',
        credit_maturity: '',
        type: '',
        spouses_birth_certificate: '',
        official_identification_of_the_spouse: '',
        marriage_certificate: '',
      },
      fovissste: {
        credit_simulator: '',
        curp: '',
        birth_certificate: '',
        bank_statement: '',
        single_key_housing_payment: '',
        general_buyers_and_sellers: '',
        education_course: '',
        last_pay_stub: '',
      },
      cofinavit: {
        request_for_credit_inspection: '',
        birth_certificate: '',
        official_id: '',
        curp: '',
        rfc: '',
        bank_statement_seller: '',
        tax_valuation: '',
        scripture_copy: '',
        type: '',
        birth_certificate_of_the_spouse: '',
        official_identification_of_the_spouse: '',
        marriage_certificate: '',
      },
      banking: {
        contract_with_the_broker: '',
      },
      allies: {
        mortgage_broker: '',
      },
    },
  },
  computed: {
    isInfonavit() {
      return this.contract.mortgage_credit === 'INFONAVIT'
    },
    isInfonavitMarried() {
      return this.contract.infonavit.type === 'Conyugal'
    },
    isFovissste() {
      return this.contract.mortgage_credit === 'FOVISSSTE'
    },
    isCofinavit() {
      return this.contract.mortgage_credit === 'COFINAVIT'
    },
    isCofinavitMarried() {
      return this.contract.cofinavit.type === 'Conyugal'
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
    console.log(this.initials);
  }
}
