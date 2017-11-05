<template>
  <div v-show="hasClient">
    <p v-show="hasPhoneOne" class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8">Teléfono: {{ phoneOne }}</p>
    <p v-show="hasPhoneTwo" class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8">Teléfono: {{ phoneTwo }}</p>
    <p v-show="hasEmail" class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8">Email: <a :href="email | mailto" :title="email">{{ email }}</a></p>

    <p class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8">
      ¿No es el cliente que querías? Selecciona otro o
      <a
        href="#"
        title="crea uno nuevo"
        target="_self"
        data-toggle="modal"
        data-target="#newClient">crea uno nuevo</a>
    </p>
  </div>
</template>

<script>
  export default {
    template: '#client',
    props: {
      phoneOne: {
        type: String,
        default: '',
        required: true
      },
      phoneTwo: {
        type: String,
        default: ''
      },
      email: {
        type: String,
        default: ''
      },
      hasClient: {
        type: Boolean,
        required: true,
        default: false
      }
    },
    computed: {
      hasPhoneOne: function () {
        return this.phoneOne.length !== 0
      },
      hasPhoneTwo: function () {
        return this.phoneTwo.length !== 0
      },
      hasEmail: function () {
        return this.email.length !== 0
      }
    },
    filters: {
      mailto: function (value) {
        if (!value) return ''

        return 'mailto:' + value
      }
    }
  }
</script>
