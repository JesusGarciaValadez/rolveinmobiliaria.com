
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
          const environment = process.env.NODE_ENV
          const uri = `/api/clients/show/${clientId}`
          const localUrl = `http://local.rolveinmobiliaria.com${uri}`
          const productionUrl = `http://45.77.197.22${uri}`

          const url = (environment !== 'production')
            ? localUrl
            : productionUrl

          const inicialization = {
            withCredentials: false
          }

          axios.get(url, inicialization)
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
          const environment = process.env.NODE_ENV
          const uri = `/api/internal_expedients/show/${expedientId}`
          const localUrl = `http://local.rolveinmobiliaria.com${uri}`
          const productionUrl = `http://45.77.197.22${uri}`

          const url = (environment !== 'production')
            ? localUrl
            : productionUrl

          const inicialization = {
            withCredentials: false
          }

          axios.get(url, inicialization)
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
  const PurchaseSale = new Vue({
    el: '#purchase-sale',
    data: {
      documents: {
        predial: {
          type: Boolean,
          default: false,
          required: true
        },
        light: {
          type: Boolean,
          default: false,
          required: true
        },
        water: {
          type: Boolean,
          default: false,
          required: true
        },
        deed: {
          type: Boolean,
          default: false,
          required: true
        },
        general_sheet: {
          type: Boolean,
          default: false,
          required: false
        },
        INE: {
          type: Boolean,
          default: false,
          required: false
        },
        CURP: {
          type: Boolean,
          default: false,
          required: false
        },
        birth_certificate: {
          type: Boolean,
          default: false,
          required: false
        },
        account_status: {
          type: Boolean,
          default: false,
          required: false
        },
        email: {
          type: Boolean,
          default: false,
          required: false
        },
        phone: {
          type: Boolean,
          default: false,
          required: false
        },
        civil_status: {
          type: String,
          default: '',
          required: true
        }
      },
      closingContract: {
        commercial_valuation: {
          type: Boolean,
          default: false,
          required: true
        },
        exclusivity_contract: {
          type: Boolean,
          default: false,
          required: true
        },
        publication: {
          type: Boolean,
          default: false,
          required: true
        },
        data_sheet: {
          type: String,
          default: '',
          required: true
        },
        observations: {
          type: String,
          default: 'Observaciones',
          required: true
        }
      },
      purchaseAgreement: {
        general_buyer: {
          type: Boolean,
          default: false,
          required: true
        },
        purchase_agreements: {
          type: Boolean,
          default: false,
          required: true
        },
        tax_assessment: {
          type: Boolean,
          default: false,
          required: true
        },
        notary_checklist: {
          type: Boolean,
          default: false,
          required: true
        },
        notary_file: {
          type: Boolean,
          default: false,
          required: true
        },
        mortgage_credit: {
          type: String,
          default: '',
          required: true
        },
        infonavit: {
          certified_birth_certificate: {
            type: Boolean,
            default: false,
            required: true
          },
          official_ID: {
            type: Boolean,
            default: false,
            required: true
          },
          curp: {
            type: Boolean,
            default: false,
            required: true
          },
          rfc: {
            type: Boolean,
            default: false,
            required: true
          },
          credit_simulator: {
            type: Boolean,
            default: false,
            required: true
          },
          credit_application: {
            type: Boolean,
            default: false,
            required: true
          },
          tax_valuation: {
            type: Boolean,
            default: false,
            required: true
          },
          bank_statement: {
            type: Boolean,
            default: false,
            required: true
          },
          workshop_knowing_how_to_decide: {
            type: Boolean,
            default: false,
            required: true
          },
          retention_sheet: {
            type: Boolean,
            default: false,
            required: true
          },
          credit_activation: {
            type: Boolean,
            default: false,
            required: true
          },
          credit_maturity: {
            type: Boolean,
            default: false,
            required: true
          },
          type: {
            type: Boolean,
            default: false,
            required: true
          },
          spouses_birth_certificate: {
            type: Boolean,
            default: false,
            required: true
          },
          official_identification_of_the_spouse: {
            type: Boolean,
            default: false,
            required: true
          },
          marriage_certificate: {
            type: Boolean,
            default: false,
            required: true
          }
        },
        fovissste: {
          credit_simulator: {
            type: Boolean,
            default: false,
            required: true
          },
          curp: {
            type: Boolean,
            default: false,
            required: true
          },
          birth_certificate: {
            type: Boolean,
            default: false,
            required: true
          },
          bank_statement: {
            type: Boolean,
            default: false,
            required: true
          },
          single_key_housing_payment: {
            type: Boolean,
            default: false,
            required: true
          },
          general_buyers_and_sellers: {
            type: Boolean,
            default: false,
            required: true
          },
          education_course: {
            type: Boolean,
            default: false,
            required: true
          },
          last_pay_stub: {
            type: Boolean,
            default: false,
            required: true
          },
          notary_file: {
            type: Boolean,
            default: false,
            required: true
          }
        },
        cofinavit: {
          request_for_credit_inspection: {
            type: Boolean,
            default: false,
            required: true
          },
          birth_certificate: {
            type: Boolean,
            default: false,
            required: true
          },
          official_id: {
            type: Boolean,
            default: false,
            required: true
          },
          curp: {
            type: Boolean,
            default: false,
            required: true
          },
          rfc: {
            type: Boolean,
            default: false,
            required: true
          },
          bank_statement_seller: {
            type: Boolean,
            default: false,
            required: true
          },
          tax_valuation: {
            type: Boolean,
            default: false,
            required: true
          },
          scripture_copy: {
            type: Boolean,
            default: false,
            required: true
          },
          type: {
            type: Boolean,
            default: false,
            required: true
          },
          birth_certificate_of_the_spouse: {
            type: Boolean,
            default: false,
            required: true
          },
          official_identification_of_the_spouse: {
            type: Boolean,
            default: false,
            required: true
          },
          marriage_certificate: {
            type: Boolean,
            default: false,
            required: true
          }
        },
        banking: {
          contract_with_the_broker: {
            type: Boolean,
            default: false,
            required: true
          }
        },
        allies: {
          mortgage_broker: {
            type: Boolean,
            default: false,
            required: true
          }
        }
      },
      notary: {
        federal_entity: {
          type: Boolean,
          default: false,
          required: true
        },
        notaries_office: {
          type: Boolean,
          default: false,
          required: true
        },
        freedom_of_lien_certificate: {
          type: Boolean,
          default: false,
          required: true
        },
        zoning: {
          type: Boolean,
          default: false,
          required: true
        },
        water_no_due_constants: {
          type: Boolean,
          default: false,
          required: true
        },
        non_debit_proof_of_property: {
          type: Boolean,
          default: false,
          required: true
        },
        certificate_of_improvement: {
          type: Boolean,
          default: false,
          required: true
        },
        key_and_cadastral_value: {
          type: Boolean,
          default: false,
          required: true
        }
      },
      signature: {
        writing_review: {
          type: Boolean,
          default: false,
          required: true
        },
        scheduled_date_of_writing_signature: {
          type: Boolean,
          default: false,
          required: true
        },
        writing_signature: {
          type: Boolean,
          default: false,
          required: true
        },
        scheduled_payment_date: {
          type: Boolean,
          default: false,
          required: true
        },
        payment_made: {
          type: Boolean,
          default: false,
          required: true
        }
      }
    },
    computed: {
      documentsIsComplete: function () {
        return (
          this.documents.predial.default &&
          this.documents.light.default &&
          this.documents.water.default &&
          this.documents.deed.default &&
          this.documents.civil_status.default !== ''
        )
      },
      closingContractIsComplete: function () {
        return (
          this.closingContract.commercial_valuation.default &&
          this.closingContract.exclusivity_contract.default &&
          this.closingContract.publication.default &&
          this.closingContract.data_sheet.default !== '' &&
          this.closingContract.observations.default !== 'Observaciones' &&
          this.closingContract.observations.default !== ''
        )
      },
      logOfVisitsAndCallsIsComplete: function () {
        return true
      },
      purchaseAgreementIsComplete: function () {
        return (
          this.purchaseAgreement.general_buyer.default &&
          this.purchaseAgreement.purchase_agreements.default &&
          this.purchaseAgreement.tax_assessment.default &&
          this.purchaseAgreement.notary_checklist.default &&
          this.purchaseAgreement.notary_file.default &&
          this.purchaseAgreement.mortgage_credit.default !== '' &&
          (
            this.purchaseAgreement.infonavit.certified_birth_certificate.default &&
            this.purchaseAgreement.infonavit.official_ID.default &&
            this.purchaseAgreement.infonavit.curp.default &&
            this.purchaseAgreement.infonavit.rfc.default &&
            this.purchaseAgreement.infonavit.credit_simulator.default &&
            this.purchaseAgreement.infonavit.credit_application.default &&
            this.purchaseAgreement.infonavit.tax_valuation.default &&
            this.purchaseAgreement.infonavit.bank_statement.default &&
            this.purchaseAgreement.infonavit.workshop_knowing_how_to_decide.default &&
            this.purchaseAgreement.infonavit.retention_sheet.default &&
            this.purchaseAgreement.infonavit.credit_activation.default &&
            this.purchaseAgreement.infonavit.credit_maturity.default &&
            (
              this.purchaseAgreement.infonavit.type.default === 'Individual' ||
              (
                this.purchaseAgreement.infonavit.type.default === 'Conyugal' &&
                (
                  this.purchaseAgreement.infonavit.spouses_birth_certificate.default &&
                  this.purchaseAgreement.infonavit.official_identification_of_the_spouse.default &&
                  this.purchaseAgreement.infonavit.marriage_certificate.default
                )
              )
            )
          ) ||
          (
            this.purchaseAgreement.fovissste.credit_simulator.default &&
            this.purchaseAgreement.fovissste.curp.default &&
            this.purchaseAgreement.fovissste.birth_certificate.default &&
            this.purchaseAgreement.fovissste.bank_statement.default &&
            this.purchaseAgreement.fovissste.single_key_housing_payment.default &&
            this.purchaseAgreement.fovissste.general_buyers_and_sellers.default &&
            this.purchaseAgreement.fovissste.ducation_course.default &&
            this.purchaseAgreement.fovissste.last_pay_stub.default &&
            this.purchaseAgreement.fovissste.notary_file.default
          ) ||
          (
            this.purchaseAgreement.cofinavit.request_for_credit_inspection.default &&
            this.purchaseAgreement.cofinavit.birth_certificate.default &&
            this.purchaseAgreement.cofinavit.official_id.default &&
            this.purchaseAgreement.cofinavit.curp.default &&
            this.purchaseAgreement.cofinavit.rfc.default &&
            this.purchaseAgreement.cofinavit.bank_statement_seller.default &&
            this.purchaseAgreement.cofinavit.ax_valuation.default &&
            this.purchaseAgreement.cofinavit.scripture_copy.default &&
            (
              this.purchaseAgreement.cofinavit.type.default === 'Individual' ||
              (
                this.purchaseAgreement.cofinavit.type.default === 'Conyugal' &&
                (
                  this.purchaseAgreement.cofinavit.birth_certificate_of_the_spouse.default &&
                  this.purchaseAgreement.cofinavit.official_identification_of_the_spouse.default &&
                  this.purchaseAgreement.cofinavit.marriage_certificate.default
                )
              )
            )
          ) ||
          this.purchaseAgreement.banking.contract_with_the_broker.default ||
          this.purchaseAgreement.allies.mortgage_broker.default
        )
      },
      notaryIsComplete: function () {
        return (
          this.notary.federal_entity.default &&
          this.notary.notaries_office.default &&
          this.notary.freedom_of_lien_certificate.default &&
          this.notary.zoning.default &&
          this.notary.water_no_due_constants.default &&
          this.notary.non_debit_proof_of_property.default &&
          this.notary.certificate_of_improvement.default &&
          this.notary.key_and_cadastral_value.default
        )
      },
      signatureIsComplete: function () {
        return (
          this.signature.writing_review.default &&
          this.signature.scheduled_date_of_writing_signature.default &&
          this.signature.writing_signature.default &&
          this.signature.scheduled_payment_date.default &&
          this.signature.payment_made.default
        )
      },
      isINFONAVIT: function () {
        this.resetFovisssteData()
        this.resetCofinavitData()
        this.resetBankingData()
        this.resetAlliesData()

        return (this.purchaseAgreement.mortgage_credit.default === 'INFONAVIT')
      },
      isINFONAVITMarried: function () {
        return (this.purchaseAgreement.infonavit.type.default === 'Conyugal')
      },
      isFOVISSSTE: function () {
        this.resetInfonavitData()
        this.resetCofinavitData()
        this.resetBankingData()
        this.resetAlliesData()

        return (this.purchaseAgreement.mortgage_credit.default === 'FOVISSSTE')
      },
      isCOFINAVIT: function () {
        this.resetInfonavitData()
        this.resetFovisssteData()
        this.resetBankingData()
        this.resetAlliesData()

        return (this.purchaseAgreement.mortgage_credit.default === 'COFINAVIT')
      },
      isCOFINAVITMarried: function () {
        return (this.purchaseAgreement.cofinavit.type.default === 'Conyugal')
      },
      isBanking: function () {
        this.resetInfonavitData()
        this.resetFovisssteData()
        this.resetCofinavitData()
        this.resetAlliesData()

        return (this.purchaseAgreement.mortgage_credit.default === 'Bancario')
      },
      isAllies: function () {
        this.resetInfonavitData()
        this.resetFovisssteData()
        this.resetCofinavitData()
        this.resetBankingData()

        return (this.purchaseAgreement.mortgage_credit.default === 'Aliados')
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
      showPurchaseAgreement: function () {
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
          this.purchaseAgreementIsComplete
        )
      },
      showSignature: function () {
        return (
          this.documentsIsComplete &&
          this.closingContractIsComplete &&
          this.logOfVisitsAndCallsIsComplete &&
          this.purchaseAgreementIsComplete &&
          this.notaryIsComplete
        )
      }
    },
    methods: {
      resetInfonavitData: function () {
        this.purchaseAgreement.infonavit.certified_birth_certificate.default = false
        this.purchaseAgreement.infonavit.official_ID.default = false
        this.purchaseAgreement.infonavit.curp.default = false
        this.purchaseAgreement.infonavit.rfc.default = false
        this.purchaseAgreement.infonavit.credit_simulator.default = false
        this.purchaseAgreement.infonavit.credit_application.default = false
        this.purchaseAgreement.infonavit.tax_valuation.default = false
        this.purchaseAgreement.infonavit.bank_statement.default = false
        this.purchaseAgreement.infonavit.workshop_knowing_how_to_decide.default = false
        this.purchaseAgreement.infonavit.retention_sheet.default = false
        this.purchaseAgreement.infonavit.credit_activation.default = false
        this.purchaseAgreement.infonavit.credit_maturity.default = false
        this.purchaseAgreement.infonavit.type.default = false
        this.purchaseAgreement.infonavit.spouses_birth_certificate.default = false
        this.purchaseAgreement.infonavit.official_identification_of_the_spouse.default = false
        this.purchaseAgreement.infonavit.marriage_certificate.default = false
      },
      resetFovisssteData: function () {
        this.purchaseAgreement.fovissste.credit_simulator.default = false
        this.purchaseAgreement.fovissste.curp.default = false
        this.purchaseAgreement.fovissste.birth_certificate.default = false
        this.purchaseAgreement.fovissste.bank_statement.default = false
        this.purchaseAgreement.fovissste.single_key_housing_payment.default = false
        this.purchaseAgreement.fovissste.general_buyers_and_sellers.default = false
        this.purchaseAgreement.fovissste.education_course.default = false
        this.purchaseAgreement.fovissste.last_pay_stub.default = false
        this.purchaseAgreement.fovissste.notary_file.default = false
      },
      resetCofinavitData: function () {
        this.purchaseAgreement.cofinavit.request_for_credit_inspection.default = false
        this.purchaseAgreement.cofinavit.birth_certificate.default = false
        this.purchaseAgreement.cofinavit.official_id.default = false
        this.purchaseAgreement.cofinavit.curp.default = false
        this.purchaseAgreement.cofinavit.rfc.default = false
        this.purchaseAgreement.cofinavit.bank_statement_seller.default = false
        this.purchaseAgreement.cofinavit.tax_valuation.default = false
        this.purchaseAgreement.cofinavit.scripture_copy.default = false
        this.purchaseAgreement.cofinavit.type.default = false
        this.purchaseAgreement.cofinavit.birth_certificate_of_the_spouse.default = false
        this.purchaseAgreement.cofinavit.official_identification_of_the_spouse.default = false
        this.purchaseAgreement.cofinavit.marriage_certificate.default = false
      },
      resetBankingData: function () {
        this.purchaseAgreement.banking.contract_with_the_broker.default = false
      },
      resetAlliesData: function () {
        this.purchaseAgreement.allies.mortgage_broker.default = false
      },
      onUpload: function (event) {
        const fileUpload = event.currentTarget

        if (
          fileUpload.name === 'SCC_data_sheet' &&
          fileUpload.value !== ''
        ) {
          this.closingContract.data_sheet.default = true
        } else {
          this.closingContract.data_sheet.default = false
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
      }
    }
  })
}
