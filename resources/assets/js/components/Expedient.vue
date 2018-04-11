<template>
  <div class="clearfix block col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-2 col-md-9 col-lg-offset-2 col-lg-10 alert alert-info" v-if="!isEmpty">
    <div>
      <p v-show="hasExpedient"><strong>Expediente interno:</strong> {{ expedient }}</p>
    </div>

    <client
      :name="name"
      :phone-one="phoneOne"
      :phone-two="phoneTwo"
      :business="business"
      :email-one="emailOne"
      :email-two="emailTwo"
      :reference="reference"
      v-if="hasClient"></client>
  </div>
</template>

<script>
  import Vue from 'vue'
  import client from './Client'

  Vue.component('client', client)

  export default {
    name: 'expedient',
    children: ['client'],
    props: {
      expedient: {
        type: String,
        default: '',
        required: true
      },
      name: {
        type: String,
        default: '',
        required: true
      },
      phoneOne: {
        type: String,
        default: '',
        required: true
      },
      phoneTwo: {
        type: String,
        default: ''
      },
      business: {
        type: String,
        default: ''
      },
      emailOne: {
        type: String,
        default: ''
      },
      emailTwo: {
        type: String,
        default: ''
      },
      reference: {
        type: String,
        default: ''
      },
      hasClient: {
        type: Boolean,
        default: false,
        required: true
      },
      empty: {
        type: Boolean,
        default: true,
        required: false
      }
    },
    computed: {
      isEmpty: function () {
        return this.empty
      },
      hasExpedient: function () {
        return this.expedient.length !== 0
      }
    }
  }
</script>
