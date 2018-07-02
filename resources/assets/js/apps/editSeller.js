import Vue from 'vue'
import Vuex, { mapState, mapGetters, mapActions } from 'vuex'
import store from '../store/sale'
import axios from 'axios'
import Spinner from '../components/Spinner'
import Expedient from '../components/Expedient'
import Client from '../components/Client'

export default {
  el: '#edit__seller',
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
      'sellerIsComplete',
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
        let form = document.getElementById('sale__seller')
        form.submit()
      }
      return false
    },
    setSellerDeed(event) {
      this.$store.commit('updateSellerDeed', document.getElementById('SD_deed').checked)
    },
    setSellerWater(event) {
      this.$store.commit('updateSellerWater', document.getElementById('SD_water').checked)
    },
    setSellerPredial(event) {
      this.$store.commit('updateSellerPredial', document.getElementById('SD_predial').checked)
    },
    setSellerLight(event) {
      this.$store.commit('updateSellerLight', document.getElementById('SD_light').checked)
    },
    setSellerBirthCertificate(event) {
      this.$store.commit('updateSellerBirthCertificate', document.getElementById('SD_birth_certificate').checked)
    },
    setSellerID(event) {
      this.$store.commit('updateSellerID', document.getElementById('SD_ID').checked)
    },
    setSellerCURP(event) {
      this.$store.commit('updateSellerCURP', document.getElementById('SD_CURP').value)
    },
    setSellerRFC(event) {
      this.$store.commit('updateSellerRFC', document.getElementById('SD_RFC').value)
    },
    setSellerAccountStatus(event) {
      this.$store.commit('updateSellerAccountStatus', document.getElementById('SD_account_status').checked)
    },
    setSellerEmail(event) {
      this.$store.commit('updateSellerEmail', document.getElementById('SD_email').checked)
    },
    setSellerPhone(event) {
      this.$store.commit('updateSellerPhone', document.getElementById('SD_phone').checked)
    },
    setSellerCivilStatus(event) {
      this.$store.commit('updateSellerCivilStatus', document.getElementById('SD_civil_status').value)
    },
    updateSellerDeed(event) {
      this.$store.commit('updateSellerDeed', event.target.checked)
    },
    updateSellerWater(event) {
      this.$store.commit('updateSellerWater', event.target.checked)
    },
    updateSellerPredial(event) {
      this.$store.commit('updateSellerPredial', event.target.checked)
    },
    updateSellerLight(event) {
      this.$store.commit('updateSellerLight', event.target.checked)
    },
    updateSellerBirthCertificate(event) {
      this.$store.commit('updateSellerBirthCertificate', event.target.checked)
    },
    updateSellerID(event) {
      this.$store.commit('updateSellerID', event.target.checked)
    },
    updateSellerCURP(event) {
      this.$store.commit('updateSellerCURP', event.target.value)
    },
    updateSellerRFC(event) {
      this.$store.commit('updateSellerRFC', event.target.value)
    },
    updateSellerAccountStatus(event) {
      this.$store.commit('updateSellerAccountStatus', event.target.checked)
    },
    updateSellerEmail(event) {
      this.$store.commit('updateSellerEmail', event.target.checked)
    },
    updateSellerPhone(event) {
      this.$store.commit('updateSellerPhone', event.target.checked)
    },
    updateSellerCivilStatus(event) {
      this.$store.commit('updateSellerCivilStatus', event.target.value)
    }
  },
  created() {
    this.setSellerDeed()
    this.setSellerWater()
    this.setSellerPredial()
    this.setSellerLight()
    this.setSellerBirthCertificate()
    this.setSellerID()
    this.setSellerCURP()
    this.setSellerRFC()
    this.setSellerAccountStatus()
    this.setSellerEmail()
    this.setSellerPhone()
    this.setSellerCivilStatus()
  },
  beforeMounted() {
    this.getClientInfo()
  },
  mounted() {

  }
}
