
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

const Vue = window.Vue

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Spinner', require('./components/Spinner.vue'))
Vue.component('Expedient', require('./components/Expedient.vue'))
Vue.component('Client', require('./components/Client.vue'))

const clientRoot = document.getElementById('client-info') || null
const salesRoot = document.getElementById('purchase-sale') || null

if (clientRoot !== null) {
  const ClientInfo = new Vue({
    el: '#client-info',
    data: {
      clientId: '',
      clientFirstName: '',
      clientLastName: '',
      clientExpedient: '',
      clientPhoneOne: '',
      clientPhoneTwo: '',
      clientBusiness: '',
      clientEmailOne: '',
      clientEmailTwo: '',
      clientReference: '',
      loading: false,
      empty: true
    },
    computed: {
      hasClient: function () {
        return (
          this.clientPhoneOne.length !== 0 ||
          this.clientPhoneTwo.length !== 0 ||
          this.clientEmailOne.length !== 0 ||
          this.clientEmailTwo.length !== 0
        )
      },
      hasExpedient: function () {
        return (
          this.clientReference.length !== 0
        )
      },
      fullName: function () {
        return this.clientFirstName + ' ' + this.clientLastName
      }
    },
    methods: {
      getClientInfo: function () {
        const clientId = document.getElementById('client_id').value

        if (clientId !== '') {
          const uri = `/api/clients/show/${clientId}`

          const inicialization = {
            withCredentials: false
          }

          axios.get(uri, inicialization)
              .then(response => response.data[0])
              .catch(error => console.log(error))
              .then(response => {
                this.loading = false
                this.clientId = response.id || ''
                this.clientFirstName = response.first_name || ''
                this.clientLastName = response.last_name || ''
                this.clientPhoneOne = response.phone_1 || ''
                this.clientPhoneTwo = response.phone_2 || ''
                this.clientBusiness = response.business || ''
                this.clientEmailOne = response.email_1 || ''
                this.clientEmailTwo = response.email_2 || ''
                this.clientReference = response.reference || ''
                this.empty = false
              })
        } else {
          this.loading = false
          this.clientId = ''
          this.clientFirstName = ''
          this.clientLastName = ''
          this.clientPhoneOne = ''
          this.clientPhoneTwo = ''
          this.clientEmailOne = ''
          this.clientEmailTwo = ''
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
              this.clientId = response.id || ''
              this.clientExpedient = response.expedient || ''
              this.clientFirstName = response.client.first_name || ''
              this.clientLastName = response.client.last_name || ''
              this.clientPhoneOne = response.client.phone_1 || ''
              this.clientPhoneTwo = response.client.phone_2 || ''
              this.clientBusiness = response.client.business || ''
              this.clientEmailOne = response.client.email_1 || ''
              this.clientEmailTwo = response.client.email_2 || ''
              this.clientReference = response.client.reference || ''
              this.loading = false
              this.empty = false
            })
        } else {
          this.loading = false
          this.clientId = ''
          this.clientFirstName = ''
          this.clientLastName = ''
          this.clientPhoneOne = ''
          this.clientPhoneTwo = ''
          this.clientEmailOne = ''
          this.clientEmailTwo = ''
          this.empty = false
        }
      }
    },
    created: function () {
      const withExpedient = document.getElementById('internal_expedient_id').value

      if (withExpedient !== '') {
        this.empty = false
      }
    },
    mounted: function () {
      if (this.empty === false) {
        this.getExpedientInfo()
      }
    }
  })
}

if (salesRoot !== null) {
  const vm = new Vue({
    el: '#purchase-sale',
    data: {
      documents: {
        predial: false,
        light: false,
        water: false,
        deed: false,
        generals_sheet: false,
        INE: false,
        CURP: false,
        birth_certificate: false,
        account_status: false,
        email: false,
        phone: false,
        civil_status: ''
      },
      closingContract: {
        commercial_valuation: false,
        exclusivity_contract: false,
        publication: false,
        data_sheet: '',
        observations: ''
      },
      contract: {
        general_buyer: false,
        purchase_agreements: false,
        tax_assessment: false,
        notary_checklist: false,
        notary_file: false,
        mortgage_credit: '',
        infonavit: {
          certified_birth_certificate: false,
          official_ID: false,
          curp: false,
          rfc: false,
          credit_simulator: false,
          credit_application: false,
          tax_valuation: false,
          bank_statement: false,
          workshop_knowing_how_to_decide: false,
          retention_sheet: false,
          credit_activation: false,
          credit_maturity: false,
          type: '',
          spouses_birth_certificate: false,
          official_identification_of_the_spouse: false,
          marriage_certificate: false
        },
        fovissste: {
          credit_simulator: false,
          curp: false,
          birth_certificate: false,
          bank_statement: false,
          single_key_housing_payment: false,
          general_buyers_and_sellers: false,
          education_course: false,
          last_pay_stub: false
        },
        cofinavit: {
          request_for_credit_inspection: false,
          birth_certificate: false,
          official_id: false,
          curp: false,
          rfc: false,
          bank_statement_seller: false,
          tax_valuation: false,
          scripture_copy: false,
          type: '',
          birth_certificate_of_the_spouse: false,
          official_identification_of_the_spouse: false,
          marriage_certificate: false
        },
        banking: {
          contract_with_the_broker: false
        },
        allies: {
          mortgage_broker: false
        }
      },
      notary: {
        federal_entity: '',
        notaries_office: '',
        freedom_of_lien_certificate: false,
        zoning: false,
        water_no_due_constants: false,
        non_debit_proof_of_property: false,
        certificate_of_improvement: false,
        key_and_cadastral_value: false
      },
      signature: {
        writing_review: false,
        scheduled_date_of_writing_signature: false,
        writing_signature: false,
        scheduled_payment_date: false,
        payment_made: false
      }
    },
    computed: {
      documentsIsComplete: function () {
        return (
          this.documents.predial &&
          this.documents.light &&
          this.documents.water &&
          this.documents.deed &&
          this.documents.civil_status !== ''
        )
      },
      closingContractIsComplete: function () {
        return (
          this.closingContract.commercial_valuation &&
          this.closingContract.exclusivity_contract &&
          this.closingContract.publication &&
          this.closingContract.observations !== 'Observaciones' &&
          this.closingContract.observations !== ''
        )
      },
      logOfVisitsAndCallsIsComplete: function () {
        return true
      },
      contractIsComplete: function () {
        return (
          this.contract.general_buyer &&
          this.contract.purchase_agreements &&
          this.contract.tax_assessment &&
          this.contract.notary_checklist &&
          this.contract.notary_file &&
          this.contract.mortgage_credit !== '' &&
          (
            this.contract.infonavit.certified_birth_certificate &&
            this.contract.infonavit.official_ID &&
            this.contract.infonavit.curp &&
            this.contract.infonavit.rfc &&
            this.contract.infonavit.credit_simulator &&
            this.contract.infonavit.credit_application &&
            this.contract.infonavit.tax_valuation &&
            this.contract.infonavit.bank_statement &&
            this.contract.infonavit.workshop_knowing_how_to_decide &&
            this.contract.infonavit.retention_sheet &&
            this.contract.infonavit.credit_activation &&
            this.contract.infonavit.credit_maturity &&
            (
              this.contract.infonavit.type === 'Individual' ||
              (
                this.contract.infonavit.type === 'Conyugal' &&
                (
                  this.contract.infonavit.spouses_birth_certificate &&
                  this.contract.infonavit.official_identification_of_the_spouse &&
                  this.contract.infonavit.marriage_certificate
                )
              )
            )
          ) ||
          (
            this.contract.fovissste.credit_simulator &&
            this.contract.fovissste.curp &&
            this.contract.fovissste.birth_certificate &&
            this.contract.fovissste.bank_statement &&
            this.contract.fovissste.single_key_housing_payment &&
            this.contract.fovissste.general_buyers_and_sellers &&
            this.contract.fovissste.education_course &&
            this.contract.fovissste.last_pay_stub
          ) ||
          (
            this.contract.cofinavit.request_for_credit_inspection &&
            this.contract.cofinavit.birth_certificate &&
            this.contract.cofinavit.official_id &&
            this.contract.cofinavit.curp &&
            this.contract.cofinavit.rfc &&
            this.contract.cofinavit.bank_statement_seller &&
            this.contract.cofinavit.ax_valuation &&
            this.contract.cofinavit.scripture_copy &&
            (
              this.contract.cofinavit.type === 'Individual' ||
              (
                this.contract.cofinavit.type === 'Conyugal' &&
                (
                  this.contract.cofinavit.birth_certificate_of_the_spouse &&
                  this.contract.cofinavit.official_identification_of_the_spouse &&
                  this.contract.cofinavit.marriage_certificate
                )
              )
            )
          ) ||
          this.contract.banking.contract_with_the_broker ||
          this.contract.allies.mortgage_broker
        )
      },
      notaryIsComplete: function () {
        return (
          this.notary.federal_entity &&
          this.notary.notaries_office &&
          this.notary.freedom_of_lien_certificate &&
          this.notary.zoning &&
          this.notary.water_no_due_constants &&
          this.notary.non_debit_proof_of_property &&
          this.notary.certificate_of_improvement &&
          this.notary.key_and_cadastral_value
        )
      },
      signatureIsComplete: function () {
        return (
          this.signature.writing_review &&
          this.signature.scheduled_date_of_writing_signature &&
          this.signature.writing_signature &&
          this.signature.scheduled_payment_date &&
          this.signature.payment_made
        )
      },
      saleIsComplete: function () {
        return (this.documentsIsComplete && this.closingContractIsComplete && this.contractIsComplete && this.notaryIsComplete && this.signatureIsComplete)
      },
      isINFONAVIT: function () {
        // this.resetFovisssteData()
        // this.resetCofinavitData()
        // this.resetBankingData()
        // this.resetAlliesData()

        return (this.contract.mortgage_credit === 'INFONAVIT')
      },
      isINFONAVITMarried: function () {
        return (this.contract.infonavit.type === 'Conyugal')
      },
      isFOVISSSTE: function () {
        // this.resetInfonavitData()
        // this.resetCofinavitData()
        // this.resetBankingData()
        // this.resetAlliesData()

        return (this.contract.mortgage_credit === 'FOVISSSTE')
      },
      isCOFINAVIT: function () {
        // this.resetInfonavitData()
        // this.resetFovisssteData()
        // this.resetBankingData()
        // this.resetAlliesData()

        return (this.contract.mortgage_credit === 'COFINAVIT')
      },
      isCOFINAVITMarried: function () {
        return (this.contract.cofinavit.type === 'Conyugal')
      },
      isBanking: function () {
        // this.resetInfonavitData()
        // this.resetFovisssteData()
        // this.resetCofinavitData()
        // this.resetAlliesData()

        return (this.contract.mortgage_credit === 'Bancario')
      },
      isAllies: function () {
        // this.resetInfonavitData()
        // this.resetFovisssteData()
        // this.resetCofinavitData()
        // this.resetBankingData()

        return (this.contract.mortgage_credit === 'Aliados')
      },
      showClosingContract: function () {
        return (this.documentsIsComplete)
      },
      showLogOfVisitsAndCalls: function () {
        return (
          this.documentsIsComplete &&
          this.closingContractIsComplete
        )
      },
      showContract: function () {
        return (
          this.documentsIsComplete &&
          this.closingContractIsComplete &&
          this.logOfVisitsAndCallsIsComplete
        )
      },
      showNotary: function () {
        return (
          this.documentsIsComplete &&
          this.closingContractIsComplete &&
          this.logOfVisitsAndCallsIsComplete &&
          this.contractIsComplete
        )
      },
      showSignature: function () {
        return (
          this.documentsIsComplete &&
          this.closingContractIsComplete &&
          this.logOfVisitsAndCallsIsComplete &&
          this.contractIsComplete &&
          this.notaryIsComplete
        )
      }
    },
    methods: {
      resetInfonavitData: function () {
        this.contract.infonavit.certified_birth_certificate = false
        this.contract.infonavit.official_ID = false
        this.contract.infonavit.curp = false
        this.contract.infonavit.rfc = false
        this.contract.infonavit.credit_simulator = false
        this.contract.infonavit.credit_application = false
        this.contract.infonavit.tax_valuation = false
        this.contract.infonavit.bank_statement = false
        this.contract.infonavit.workshop_knowing_how_to_decide = false
        this.contract.infonavit.retention_sheet = false
        this.contract.infonavit.credit_activation = false
        this.contract.infonavit.credit_maturity = false
        this.contract.infonavit.type = ''
        this.contract.infonavit.spouses_birth_certificate = false
        this.contract.infonavit.official_identification_of_the_spouse = false
        this.contract.infonavit.marriage_certificate = false
      },
      resetFovisssteData: function () {
        this.contract.fovissste.credit_simulator = false
        this.contract.fovissste.curp = false
        this.contract.fovissste.birth_certificate = false
        this.contract.fovissste.bank_statement = false
        this.contract.fovissste.single_key_housing_payment = false
        this.contract.fovissste.general_buyers_and_sellers = false
        this.contract.fovissste.education_course = false
        this.contract.fovissste.last_pay_stub = false
      },
      resetCofinavitData: function () {
        this.contract.cofinavit.request_for_credit_inspection = false
        this.contract.cofinavit.birth_certificate = false
        this.contract.cofinavit.official_id = false
        this.contract.cofinavit.curp = false
        this.contract.cofinavit.rfc = false
        this.contract.cofinavit.bank_statement_seller = false
        this.contract.cofinavit.tax_valuation = false
        this.contract.cofinavit.scripture_copy = false
        this.contract.cofinavit.type = ''
        this.contract.cofinavit.birth_certificate_of_the_spouse = false
        this.contract.cofinavit.official_identification_of_the_spouse = false
        this.contract.cofinavit.marriage_certificate = false
      },
      resetBankingData: function () {
        this.contract.banking.contract_with_the_broker = false
      },
      resetAlliesData: function () {
        this.contract.allies.mortgage_broker = false
      },
      onUpload: function (event) {
        const fileUpload = event.currentTarget

        if (
          fileUpload.name === 'SCC_data_sheet' &&
          fileUpload.value !== ''
        ) {
          this.closingContract.data_sheet = true
        } else {
          this.closingContract.data_sheet = false
        }
      },
      onTextarea: function (event) {
        const textarea = event.currentTarget

        if (
          textarea.name === 'SCC_closing_contract_observations' &&
          textarea.value !== ''
        ) {
          this.closingContract.observations = true
        } else {
          this.closingContract.observations = false
        }
      },
      onSubmit: function (event) {
        let form = document.getElementById('purchase-sale')
        form.submit
      },
      getID: function (element) {
        return document.getElementById(element)
      },
      setDocuments: function () {
        this.documents.predial = this.getID('SD_predial').checked
        this.documents.light = this.getID('SD_light').checked
        this.documents.water = this.getID('SD_water').checked
        this.documents.deed = this.getID('SD_deed').checked
        this.documents.generals_sheet = this.getID('SD_generals_sheet').checked
        this.documents.INE = this.getID('SD_INE').checked
        this.documents.CURP = this.getID('SD_CURP').checked
        this.documents.birth_certificate = this.getID('SD_birth_certificate').checked
        this.documents.account_status = this.getID('SD_account_status').checked
        this.documents.email = this.getID('SD_email').checked
        this.documents.phone = this.getID('SD_phone').checked
        this.documents.civil_status = this.getID('SD_civil_status').value
      },
      setClosingContract: function () {
        this.closingContract.commercial_valuation = this.getID('SCC_commercial_valuation').checked
        this.closingContract.exclusivity_contract = this.getID('SCC_exclusivity_contract').checked
        this.closingContract.publication = this.getID('SCC_publication').checked
        this.closingContract.data_sheet = (this.getID('SCC_data_sheet_current') !== null)
          ? this.getID('SCC_data_sheet_current').text
          : ''
        this.closingContract.observations = this.getID('SCC_closing_contract_observations').value
      },
      setContractINFONAVIT: function () {
        this.contract.infonavit.certified_birth_certificate = this.getID('IC_certified_birth_certificate').checked
        this.contract.infonavit.official_ID = this.getID('IC_official_ID').checked
        this.contract.infonavit.curp = this.getID('IC_curp').checked
        this.contract.infonavit.rfc = this.getID('IC_rfc').checked
        this.contract.infonavit.credit_simulator = this.getID('IC_credit_simulator').checked
        this.contract.infonavit.credit_application = this.getID('IC_credit_application').checked
        this.contract.infonavit.tax_valuation = this.getID('IC_tax_valuation').checked
        this.contract.infonavit.bank_statement = this.getID('IC_bank_statement').checked
        this.contract.infonavit.workshop_knowing_how_to_decide = this.getID('IC_workshop_knowing_how_to_decide').checked
        this.contract.infonavit.retention_sheet = this.getID('IC_retention_sheet').checked
        this.contract.infonavit.credit_activation = this.getID('IC_credit_activation').checked
        this.contract.infonavit.credit_maturity = this.getID('IC_credit_maturity').checked
        this.contract.infonavit.type = this.getID('IC_type').value
        this.contract.infonavit.spouses_birth_certificate = this.getID('IC_spouses_birth_certificate').checked
        this.contract.infonavit.official_identification_of_the_spouse = this.getID('IC_official_identification_of_the_spouse').checked
        this.contract.infonavit.marriage_certificate = this.getID('IC_marriage_certificate').checked
      },
      setContractFOVISSSTE: function () {
        this.contract.fovissste.credit_simulator = this.getID('FC_credit_simulator').checked
        this.contract.fovissste.curp = this.getID('FC_curp').checked
        this.contract.fovissste.birth_certificate = this.getID('FC_birth_certificate').checked
        this.contract.fovissste.bank_statement = this.getID('FC_bank_statement').checked
        this.contract.fovissste.single_key_housing_payment = this.getID('FC_single_key_housing_payment').checked
        this.contract.fovissste.general_buyers_and_sellers = this.getID('FC_general_buyers_and_sellers').checked
        this.contract.fovissste.education_course = this.getID('FC_education_course').checked
        this.contract.fovissste.last_pay_stub = this.getID('FC_last_pay_stub').checked
      },
      setContractCOFINAVIT: function () {
        this.contract.cofinavit.request_for_credit_inspection = this.getID('CC_request_for_credit_inspection').checked
        this.contract.cofinavit.birth_certificate = this.getID('CC_birth_certificate').checked
        this.contract.cofinavit.official_id = this.getID('CC_official_id').checked
        this.contract.cofinavit.curp = this.getID('CC_curp').checked
        this.contract.cofinavit.rfc = this.getID('CC_rfc').checked
        this.contract.cofinavit.bank_statement_seller = this.getID('CC_bank_statement_seller').checked
        this.contract.cofinavit.tax_valuation = this.getID('CC_tax_valuation').checked
        this.contract.cofinavit.scripture_copy = this.getID('CC_scripture_copy').checked
        this.contract.cofinavit.type = this.getID('CC_type').value
        this.contract.cofinavit.birth_certificate_of_the_spouse = this.getID('CC_birth_certificate_of_the_spouse').checked
        this.contract.cofinavit.official_identification_of_the_spouse = this.getID('CC_official_identification_of_the_spouse').checked
        this.contract.cofinavit.marriage_certificate = this.getID('CC_marriage_certificate').checked
      },
      setContract: function () {
        this.contract.general_buyer = this.getID('SC_general_buyer').checked
        this.contract.purchase_agreements = this.getID('SC_purchase_agreements').checked
        this.contract.tax_assessment = this.getID('SC_tax_assessment').checked
        this.contract.notary_checklist = this.getID('SC_notary_checklist').checked
        this.contract.notary_file = this.getID('SC_notary_file').checked
        this.contract.mortgage_credit = this.getID('SC_mortgage_credit').value

        this.setContractINFONAVIT()
        this.setContractFOVISSSTE()
        this.setContractCOFINAVIT()

        this.contract.banking.contract_with_the_broker = this.getID('SC_contract_with_the_broker').checked
        this.contract.allies.mortgage_broker = this.getID('SC_mortgage_broker').checked
      },
      setNotary: function () {
        this.notary.federal_entity = this.getID('SN_federal_entity').value
        this.notary.notaries_office = this.getID('SN_notaries_office').value
        this.notary.freedom_of_lien_certificate = this.getID('SN_freedom_of_lien_certificate').checked
        this.notary.zoning = this.getID('SN_zoning').checked
        this.notary.water_no_due_constants = this.getID('SN_water_no_due_constants').checked
        this.notary.non_debit_proof_of_property = this.getID('SN_non_debit_proof_of_property').checked
        this.notary.certificate_of_improvement = this.getID('SN_certificate_of_improvement').checked
        this.notary.key_and_cadastral_value = this.getID('SN_key_and_cadastral_value').checked
      },
      setSignature: function () {
        this.signature.writing_review = this.getID('SS_writing_review').checked
        this.signature.scheduled_date_of_writing_signature = this.getID('SS_scheduled_date_of_writing_signature').checked
        this.signature.writing_signature = this.getID('SS_writing_signature').checked
        this.signature.scheduled_payment_date = this.getID('SS_scheduled_payment_date').checked
        this.signature.payment_made = this.getID('SS_payment_made').checked
      }
    },
    created: function () {
      this.setDocuments()
      this.setClosingContract()
      this.setContract()
      this.setNotary()
      this.setSignature()
    },
    mounted: function () {
      // console.log(this.$data)
    }
  })
}
