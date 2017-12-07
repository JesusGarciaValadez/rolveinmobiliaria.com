<template>
  <div class="clearfix block col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-10 alert alert-info">
    <div>
      <p v-show="hasExpedient"><strong>Expediente interno:</strong> {{ expedient }}</p>
    </div>

    <Client
      :name="name"
      :phone-one="phoneOne"
      :phone-two="phoneTwo"
      :business="business"
      :email-one="emailOne"
      :email-two="emailTwo"
      :reference="reference"
      :has-client="hasClient"></Client>
  </div>
</template>

<script>
  export default {
    template: '#expedient',
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
      }
    },
    computed: {
      hasExpedient: function () {
        return this.expedient.length !== 0
      }
    }
  }
</script>
