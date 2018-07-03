import axios from 'axios'

export default {
  el: '#purchase-sale',
  data: {
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
    loading: false,
    empty: true,
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
    }
  },
  components: {
    Spinner,
    Expedient,
    Client,
  },
  computed: {
    hasClient: function () {
      return (
        this.client.phoneOne.length !== 0 ||
        this.client.phoneTwo.length !== 0 ||
        this.client.emailOne.length !== 0 ||
        this.client.emailTwo.length !== 0
      )
    },
    hasExpedient: function () {
      return (
        this.client.reference.length !== 0
      )
    },
    fullName: function () {
      return this.client.firstName + ' ' + this.client.lastName
    },
    expedient: function () {
      return `${this.client.expedient.key}/${this.client.expedient.number}/${this.client.expedient.year}`
    },
    sellersIsComplete: function () {
      return (
        this.sale.seller.deed ||
        this.sale.seller.water ||
        this.sale.seller.predial ||
        this.sale.seller.light ||
        this.sale.seller.civil_status !== ''
      )
    },
    closingContractIsComplete: function () {
      return (
        this.sale.closingContract.commercial_valuation ||
        this.sale.closingContract.exclusivity_contract ||
        this.sale.closingContract.publication ||
        this.sale.closingContract.observations !== 'Observaciones' ||
        this.sale.closingContract.observations !== ''
      )
    },
    logOfVisitsAndCallsIsComplete: function () {
      return true
    },
    contractIsComplete: function () {
      return (
        this.sale.contract.general_buyer ||
        this.sale.contract.purchase_agreements ||
        this.sale.contract.tax_assessment ||
        this.sale.contract.notary_checklist ||
        this.sale.contract.notary_file ||
        this.sale.contract.mortgage_credit !== '' ||
        (
          this.sale.contract.infonavit.certified_birth_certificate ||
          this.sale.contract.infonavit.official_ID ||
          this.sale.contract.infonavit.curp ||
          this.sale.contract.infonavit.rfc ||
          this.sale.contract.infonavit.credit_simulator ||
          this.sale.contract.infonavit.credit_application ||
          this.sale.contract.infonavit.tax_valuation ||
          this.sale.contract.infonavit.bank_statement ||
          this.sale.contract.infonavit.workshop_knowing_how_to_decide ||
          this.sale.contract.infonavit.retention_sheet ||
          this.sale.contract.infonavit.credit_activation ||
          this.sale.contract.infonavit.credit_maturity ||
          (
            this.sale.contract.infonavit.type === 'Individual' ||
            (
              this.sale.contract.infonavit.type === 'Conyugal' ||
              (
                this.sale.contract.infonavit.spouses_birth_certificate ||
                this.sale.contract.infonavit.official_identification_of_the_spouse ||
                this.sale.contract.infonavit.marriage_certificate
              )
            )
          )
        ) ||
        (
          this.sale.contract.fovissste.credit_simulator ||
          this.sale.contract.fovissste.curp ||
          this.sale.contract.fovissste.birth_certificate ||
          this.sale.contract.fovissste.bank_statement ||
          this.sale.contract.fovissste.single_key_housing_payment ||
          this.sale.contract.fovissste.general_buyers_and_sellers ||
          this.sale.contract.fovissste.education_course ||
          this.sale.contract.fovissste.last_pay_stub
        ) ||
        (
          this.sale.contract.cofinavit.request_for_credit_inspection ||
          this.sale.contract.cofinavit.birth_certificate ||
          this.sale.contract.cofinavit.official_id ||
          this.sale.contract.cofinavit.curp ||
          this.sale.contract.cofinavit.rfc ||
          this.sale.contract.cofinavit.bank_statement_seller ||
          this.sale.contract.cofinavit.ax_valuation ||
          this.sale.contract.cofinavit.scripture_copy ||
          (
            this.sale.contract.cofinavit.type === 'Individual' ||
            (
              this.sale.contract.cofinavit.type === 'Conyugal' ||
              (
                this.sale.contract.cofinavit.birth_certificate_of_the_spouse ||
                this.sale.contract.cofinavit.official_identification_of_the_spouse ||
                this.sale.contract.cofinavit.marriage_certificate
              )
            )
          )
        ) ||
        this.sale.contract.banking.contract_with_the_broker ||
        this.sale.contract.allies.mortgage_broker
      )
    },
    notaryIsComplete: function () {
      return (
        this.sale.notary.federal_entity ||
        this.sale.notary.notaries_office ||
        this.sale.notary.freedom_of_lien_certificate ||
        this.sale.notary.zoning ||
        this.sale.notary.water_no_due_constants ||
        this.sale.notary.non_debit_proof_of_property ||
        this.sale.notary.certificate_of_improvement ||
        this.sale.notary.key_and_cadastral_value
      )
    },
    signatureIsComplete: function () {
      return (
        this.sale.signature.writing_review ||
        this.sale.signature.scheduled_date_of_writing_signature ||
        this.sale.signature.writing_signature ||
        this.sale.signature.scheduled_payment_date ||
        this.sale.signature.payment_made
      )
    },
    saleIsComplete: function () {
      return (this.sellersIsComplete || this.sale.closingContractIsComplete || this.contractIsComplete || this.notaryIsComplete || this.signatureIsComplete)
    },
    isINFONAVIT: function () {
      // this.resetFovisssteData()
      // this.resetCofinavitData()
      // this.resetBankingData()
      // this.resetAlliesData()

      return this.sale.contract.mortgage_credit === 'INFONAVIT'
    },
    isINFONAVITMarried: function () {
      return this.sale.contract.infonavit.type === 'Conyugal'
    },
    isFOVISSSTE: function () {
      // this.resetInfonavitData()
      // this.resetCofinavitData()
      // this.resetBankingData()
      // this.resetAlliesData()

      return this.sale.contract.mortgage_credit === 'FOVISSSTE'
    },
    isCOFINAVIT: function () {
      // this.resetInfonavitData()
      // this.resetFovisssteData()
      // this.resetBankingData()
      // this.resetAlliesData()

      return this.sale.contract.mortgage_credit === 'COFINAVIT'
    },
    isCOFINAVITMarried: function () {
      return this.sale.contract.cofinavit.type === 'Conyugal'
    },
    isBanking: function () {
      // this.resetInfonavitData()
      // this.resetFovisssteData()
      // this.resetCofinavitData()
      // this.resetAlliesData()

      return this.sale.contract.mortgage_credit === 'Bancario'
    },
    isAllies: function () {
      // this.resetInfonavitData()
      // this.resetFovisssteData()
      // this.resetCofinavitData()
      // this.resetBankingData()

      return this.sale.contract.mortgage_credit === 'Aliados'
    },
    showClosingContract: function () {
      return this.sellersIsComplete
    },
    showLogOfVisitsAndCalls: function () {
      return (
        this.sellersIsComplete &&
        this.closingContractIsComplete
      )
    },
    showContract: function () {
      return (
        this.sellersIsComplete &&
        this.closingContractIsComplete &&
        this.logOfVisitsAndCallsIsComplete
      )
    },
    showNotary: function () {
      return (
        this.sellersIsComplete &&
        this.closingContractIsComplete &&
        this.logOfVisitsAndCallsIsComplete &&
        this.contractIsComplete
      )
    },
    showSignature: function () {
      return (
        this.sellersIsComplete &&
        this.closingContractIsComplete &&
        this.logOfVisitsAndCallsIsComplete &&
        this.contractIsComplete &&
        this.notaryIsComplete
      )
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
            this.client.id = response.id || ''
            this.client.firstName = response.first_name || ''
            this.client.lastName = response.last_name || ''
            this.client.phoneOne = response.phone_1 || ''
            this.client.phoneTwo = response.phone_2 || ''
            this.client.business = response.business || ''
            this.client.emailOne = response.email_1 || ''
            this.client.emailTwo = response.email_2 || ''
            this.client.reference = response.reference || ''
            this.empty = false
          })
      } else {
        this.loading = false
        this.client.id = ''
        this.client.firstName = ''
        this.client.lastName = ''
        this.client.phoneOne = ''
        this.client.phoneTwo = ''
        this.client.emailOne = ''
        this.client.emailTwo = ''
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
            this.client.id = response.id || ''
            this.client.expedient.key = response.expedient_key || ''
            this.client.expedient.number = response.expedient_number || ''
            this.client.expedient.year = response.expedient_year || ''
            this.client.firstName = response.client.first_name || ''
            this.client.lastName = response.client.last_name || ''
            this.client.phoneOne = response.client.phone_1 || ''
            this.client.phoneTwo = response.client.phone_2 || ''
            this.client.business = response.client.business || ''
            this.client.emailOne = response.client.email_1 || ''
            this.client.emailTwo = response.client.email_2 || ''
            this.client.reference = response.client.reference || ''
            this.loading = false
            this.empty = false
          })
      } else {
        this.client.id = ''
        this.client.firstName = ''
        this.client.lastName = ''
        this.client.phoneOne = ''
        this.client.phoneTwo = ''
        this.client.emailOne = ''
        this.client.emailTwo = ''
        this.loading = false
        this.empty = true
      }
    },
    resetInfonavitData: function () {
      this.sale.contract.infonavit.certified_birth_certificate = false
      this.sale.contract.infonavit.official_ID = false
      this.sale.contract.infonavit.curp = false
      this.sale.contract.infonavit.rfc = false
      this.sale.contract.infonavit.credit_simulator = false
      this.sale.contract.infonavit.credit_application = false
      this.sale.contract.infonavit.tax_valuation = false
      this.sale.contract.infonavit.bank_statement = false
      this.sale.contract.infonavit.workshop_knowing_how_to_decide = false
      this.sale.contract.infonavit.retention_sheet = false
      this.sale.contract.infonavit.credit_activation = false
      this.sale.contract.infonavit.credit_maturity = false
      this.sale.contract.infonavit.type = ''
      this.sale.contract.infonavit.spouses_birth_certificate = false
      this.sale.contract.infonavit.official_identification_of_the_spouse = false
      this.sale.contract.infonavit.marriage_certificate = false
    },
    resetFovisssteData: function () {
      this.sale.contract.fovissste.credit_simulator = false
      this.sale.contract.fovissste.curp = false
      this.sale.contract.fovissste.birth_certificate = false
      this.sale.contract.fovissste.bank_statement = false
      this.sale.contract.fovissste.single_key_housing_payment = false
      this.sale.contract.fovissste.general_buyers_and_sellers = false
      this.sale.contract.fovissste.education_course = false
      this.sale.contract.fovissste.last_pay_stub = false
    },
    resetCofinavitData: function () {
      this.sale.contract.cofinavit.request_for_credit_inspection = false
      this.sale.contract.cofinavit.birth_certificate = false
      this.sale.contract.cofinavit.official_id = false
      this.sale.contract.cofinavit.curp = false
      this.sale.contract.cofinavit.rfc = false
      this.sale.contract.cofinavit.bank_statement_seller = false
      this.sale.contract.cofinavit.tax_valuation = false
      this.sale.contract.cofinavit.scripture_copy = false
      this.sale.contract.cofinavit.type = ''
      this.sale.contract.cofinavit.birth_certificate_of_the_spouse = false
      this.sale.contract.cofinavit.official_identification_of_the_spouse = false
      this.sale.contract.cofinavit.marriage_certificate = false
    },
    resetBankingData: function () {
      this.sale.contract.banking.contract_with_the_broker = false
    },
    resetAlliesData: function () {
      this.sale.contract.allies.mortgage_broker = false
    },
    onUpload: function (event) {
      const fileUpload = event.currentTarget

      if (
        fileUpload.name === 'SCC_data_sheet' &&
        fileUpload.value !== ''
      ) {
        this.sale.closingContract.data_sheet = true
      } else {
        this.sale.closingContract.data_sheet = false
      }
    },
    onTextarea: function (event) {
      const textarea = event.currentTarget

      if (
        textarea.name === 'SCC_closing_contract_observations' &&
        textarea.value !== ''
      ) {
        this.sale.closingContract.observations = true
      } else {
        this.sale.closingContract.observations = false
      }
    },
    onSubmit: function (event) {
      let form = document.getElementById('purchase-sale')
      form.submit()
    },
    getID: function (element) {
      return document.getElementById(element)
    },
    setSellers: function () {
      this.sale.seller.deed = this.getID('SD_deed').checked
      this.sale.seller.water = this.getID('SD_water').checked
      this.sale.seller.predial = this.getID('SD_predial').checked
      this.sale.seller.light = this.getID('SD_light').checked
      this.sale.seller.ID = this.getID('SD_ID').checked
      this.sale.seller.CURP = this.getID('SD_CURP').value
      this.sale.seller.RFC = this.getID('SD_RFC').value
      this.sale.seller.birth_certificate = this.getID('SD_birth_certificate').checked
      this.sale.seller.account_status = this.getID('SD_account_status').checked
      this.sale.seller.email = this.getID('SD_email').checked
      this.sale.seller.phone = this.getID('SD_phone').checked
      this.sale.seller.civil_status = this.getID('SD_civil_status').value
    },
    setClosingContract: function () {
      this.sale.closingContract.commercial_valuation = this.getID('SCC_commercial_valuation').checked || false
      this.sale.closingContract.exclusivity_contract = this.getID('SCC_exclusivity_contract').checked || false
      this.sale.closingContract.publication = this.getID('SCC_publication').checked || false
      this.sale.closingContract.data_sheet = (this.getID('SCC_data_sheet_current') !== null)
        ? this.getID('SCC_data_sheet_current').text
        : ''
      this.sale.closingContract.observations = this.getID('SCC_closing_contract_observations').value
    },
    setContractINFONAVIT: function () {
      this.sale.contract.infonavit.certified_birth_certificate = this.getID('IC_certified_birth_certificate').checked
      this.sale.contract.infonavit.official_ID = this.getID('IC_official_ID').checked
      this.sale.contract.infonavit.curp = this.getID('IC_curp').checked
      this.sale.contract.infonavit.rfc = this.getID('IC_rfc').checked
      this.sale.contract.infonavit.credit_simulator = this.getID('IC_credit_simulator').checked
      this.sale.contract.infonavit.credit_application = this.getID('IC_credit_application').checked
      this.sale.contract.infonavit.tax_valuation = this.getID('IC_tax_valuation').checked
      this.sale.contract.infonavit.bank_statement = this.getID('IC_bank_statement').checked
      this.sale.contract.infonavit.workshop_knowing_how_to_decide = this.getID('IC_workshop_knowing_how_to_decide').checked
      this.sale.contract.infonavit.retention_sheet = this.getID('IC_retention_sheet').checked
      this.sale.contract.infonavit.credit_activation = this.getID('IC_credit_activation').checked
      this.sale.contract.infonavit.credit_maturity = this.getID('IC_credit_maturity').checked
      this.sale.contract.infonavit.type = this.getID('IC_type').value
      this.sale.contract.infonavit.spouses_birth_certificate = this.getID('IC_spouses_birth_certificate').checked
      this.sale.contract.infonavit.official_identification_of_the_spouse = this.getID('IC_official_identification_of_the_spouse').checked
      this.sale.contract.infonavit.marriage_certificate = this.getID('IC_marriage_certificate').checked
    },
    setContractFOVISSSTE: function () {
      this.sale.contract.fovissste.credit_simulator = this.getID('FC_credit_simulator').checked
      this.sale.contract.fovissste.curp = this.getID('FC_curp').checked
      this.sale.contract.fovissste.birth_certificate = this.getID('FC_birth_certificate').checked
      this.sale.contract.fovissste.bank_statement = this.getID('FC_bank_statement').checked
      this.sale.contract.fovissste.single_key_housing_payment = this.getID('FC_single_key_housing_payment').checked
      this.sale.contract.fovissste.general_buyers_and_sellers = this.getID('FC_general_buyers_and_sellers').checked
      this.sale.contract.fovissste.education_course = this.getID('FC_education_course').checked
      this.sale.contract.fovissste.last_pay_stub = this.getID('FC_last_pay_stub').checked
    },
    setContractCOFINAVIT: function () {
      this.sale.contract.cofinavit.request_for_credit_inspection = this.getID('CC_request_for_credit_inspection').checked
      this.sale.contract.cofinavit.birth_certificate = this.getID('CC_birth_certificate').checked
      this.sale.contract.cofinavit.official_id = this.getID('CC_official_id').checked
      this.sale.contract.cofinavit.curp = this.getID('CC_curp').checked
      this.sale.contract.cofinavit.rfc = this.getID('CC_rfc').checked
      this.sale.contract.cofinavit.bank_statement_seller = this.getID('CC_bank_statement_seller').checked
      this.sale.contract.cofinavit.tax_valuation = this.getID('CC_tax_valuation').checked
      this.sale.contract.cofinavit.scripture_copy = this.getID('CC_scripture_copy').checked
      this.sale.contract.cofinavit.type = this.getID('CC_type').value
      this.sale.contract.cofinavit.birth_certificate_of_the_spouse = this.getID('CC_birth_certificate_of_the_spouse').checked
      this.sale.contract.cofinavit.official_identification_of_the_spouse = this.getID('CC_official_identification_of_the_spouse').checked
      this.sale.contract.cofinavit.marriage_certificate = this.getID('CC_marriage_certificate').checked
    },
    setContract: function () {
      this.sale.contract.general_buyer = this.getID('SC_general_buyer').checked
      this.sale.contract.purchase_agreements = this.getID('SC_purchase_agreements').checked
      this.sale.contract.tax_assessment = this.getID('SC_tax_assessment').checked
      this.sale.contract.notary_checklist = this.getID('SC_notary_checklist').checked
      this.sale.contract.notary_file = this.getID('SC_notary_file').checked
      this.sale.contract.mortgage_credit = this.getID('SC_mortgage_credit').value

      this.setContractINFONAVIT()
      this.setContractFOVISSSTE()
      this.setContractCOFINAVIT()

      this.sale.contract.banking.contract_with_the_broker = this.getID('SC_contract_with_the_broker').checked
      this.sale.contract.allies.mortgage_broker = this.getID('SC_mortgage_broker').checked
    },
    setNotary: function () {
      this.sale.notary.federal_entity = this.getID('SN_federal_entity').value
      this.sale.notary.notaries_office = this.getID('SN_notaries_office').value
      this.sale.notary.freedom_of_lien_certificate = this.getID('SN_freedom_of_lien_certificate').checked
      this.sale.notary.zoning = this.getID('SN_zoning').checked
      this.sale.notary.water_no_due_constants = this.getID('SN_water_no_due_constants').checked
      this.sale.notary.non_debit_proof_of_property = this.getID('SN_non_debit_proof_of_property').checked
      this.sale.notary.certificate_of_improvement = this.getID('SN_certificate_of_improvement').checked
      this.sale.notary.key_and_cadastral_value = this.getID('SN_key_and_cadastral_value').checked
    },
    setSignature: function () {
      this.sale.signature.writing_review = this.getID('SS_writing_review').checked
      this.sale.signature.scheduled_date_of_writing_signature = this.getID('SS_scheduled_date_of_writing_signature').checked
      this.sale.signature.writing_signature = this.getID('SS_writing_signature').checked
      this.sale.signature.scheduled_payment_date = this.getID('SS_scheduled_payment_date').checked
      this.sale.signature.payment_made = this.getID('SS_payment_made').checked
    }
  },
  created: function () {},
  mounted: function () {
    const withExpedient = document.getElementById('internal_expedient_id').value

    if (withExpedient !== '') {
      this.empty = false
    }

    if (this.empty === true) {
      this.getExpedientInfo()
    }

    this.setSellers()
    this.setClosingContract()
    this.setContract()
    this.setNotary()
    this.setSignature()
  }
}
