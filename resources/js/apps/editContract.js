import Vue from 'vue'

export default {
  el: '#edit__contract',
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
    checked(_id) {
      return document.getElementById(_id).checked;
    },
    value(_id) {
      return document.getElementById(_id).value;
    },
    onSubmit() {

    }
  },
  created() {
    this.contract.general_buyer = this.checked('SC_general_buyer')
    this.contract.purchase_agreements = this.checked('SC_purchase_agreements')
    this.contract.tax_assessment = this.checked('SC_tax_assessment')
    this.contract.notary_checklist = this.checked('SC_notary_checklist')
    this.contract.notary_file = this.checked('SC_notary_file')
    this.contract.mortgage_credit = this.value('SC_mortgage_credit')

    // Infonavit
    this.contract.infonavit.certified_birth_certificate = this.checked('IC_certified_birth_certificate')
    this.contract.infonavit.official_ID = this.checked('IC_official_ID')
    this.contract.infonavit.curp = this.checked('IC_curp')
    this.contract.infonavit.rfc = this.checked('IC_rfc')
    this.contract.infonavit.credit_simulator = this.checked('IC_credit_simulator')
    this.contract.infonavit.credit_application = this.checked('IC_credit_application')
    this.contract.infonavit.tax_valuation = this.checked('IC_tax_valuation')
    this.contract.infonavit.bank_statement = this.checked('IC_bank_statement')
    this.contract.infonavit.workshop_knowing_how_to_decide = this.checked('IC_workshop_knowing_how_to_decide')
    this.contract.infonavit.retention_sheet = this.checked('IC_retention_sheet')
    this.contract.infonavit.credit_activation = this.checked('IC_credit_activation')
    this.contract.infonavit.credit_maturity = this.checked('IC_credit_maturity')
    this.contract.infonavit.type = this.value('IC_type')
    this.contract.infonavit.spouses_birth_certificate = this.checked('IC_spouses_birth_certificate')
    this.contract.infonavit.official_identification_of_the_spouse = this.checked('IC_official_identification_of_the_spouse')
    this.contract.infonavit.marriage_certificate = this.checked('IC_marriage_certificate')

    // Fovissste
    this.contract.fovissste.credit_simulator = this.checked('FC_credit_simulator')
    this.contract.fovissste.curp = this.checked('FC_curp')
    this.contract.fovissste.birth_certificate = this.checked('FC_birth_certificate')
    this.contract.fovissste.bank_statement = this.checked('FC_bank_statement')
    this.contract.fovissste.single_key_housing_payment = this.checked('FC_single_key_housing_payment')
    this.contract.fovissste.general_buyers_and_sellers = this.checked('FC_general_buyers_and_sellers')
    this.contract.fovissste.education_course = this.checked('FC_education_course')
    this.contract.fovissste.last_pay_stub = this.checked('FC_last_pay_stub')

    // Cofinavit
    this.contract.cofinavit.request_for_credit_inspection = this.checked('CC_request_for_credit_inspection')
    this.contract.cofinavit.birth_certificate = this.checked('CC_birth_certificate')
    this.contract.cofinavit.official_id = this.checked('CC_official_id')
    this.contract.cofinavit.curp = this.checked('CC_curp')
    this.contract.cofinavit.rfc = this.checked('CC_rfc')
    this.contract.cofinavit.bank_statement_seller = this.checked('CC_bank_statement_seller')
    this.contract.cofinavit.tax_valuation = this.checked('CC_tax_valuation')
    this.contract.cofinavit.scripture_copy = this.checked('CC_scripture_copy')
    this.contract.cofinavit.type = this.value('CC_type')
    this.contract.cofinavit.birth_certificate_of_the_spouse = this.checked('CC_birth_certificate_of_the_spouse')
    this.contract.cofinavit.official_identification_of_the_spouse = this.checked('CC_official_identification_of_the_spouse')
    this.contract.cofinavit.marriage_certificate = this.checked('CC_marriage_certificate')

    // Banking
    this.contract.banking.contract_with_the_broker = this.checked('SC_contract_with_the_broker')

    // Allies
    this.contract.allies.mortgage_broker = this.checked('SC_mortgage_broker')
  },
}
