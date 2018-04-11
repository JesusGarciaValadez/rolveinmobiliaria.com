<template>
  <div>
    <p><strong>Cliente: </strong> {{ name }}</p>
    <p v-show="hasPhoneOne"><strong>Teléfono:</strong> {{ phoneOne }}</p>
    <p v-show="hasPhoneTwo"><strong>Teléfono:</strong> {{ phoneTwo }}</p>
    <p v-show="hasBusiness"><strong>Empresa:</strong> {{ business }}</p>
    <p v-show="hasEmailOne"><strong>Email:</strong> <a :href="emailOne | mailto" :title="emailOne">{{ emailOne }}</a></p>
    <p v-show="hasEmailTwo"><strong>Email:</strong> <a :href="emailTwo | mailto" :title="emailTwo">{{ emailTwo }}</a></p>
    <p v-show="hasReference"><strong>Referencia:</strong> {{ reference }}</p>

    <p>
      <strong class="text-danger">
        ¿No es el cliente que querías?
      </strong>
      <strong>
        Selecciona otro o
        <a
          href="#"
          title="crea uno nuevo"
          target="_self"
          data-toggle="modal"
          data-target="#newClient">crea uno nuevo</a>
      </strong>
    </p>
  </div>
</template>

<script>
  export default {
    name: 'client',
    props: {
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
      }
    },
    computed: {
      hasPhoneOne: function () {
        return this.phoneOne.length !== 0
      },
      hasPhoneTwo: function () {
        return this.phoneTwo.length !== 0
      },
      hasBusiness: function () {
        return this.business.length !== 0
      },
      hasEmailOne: function () {
        return this.emailOne.length !== 0
      },
      hasEmailTwo: function () {
        return this.emailTwo.length !== 0
      },
      hasReference: function () {
        return this.reference.length !== 0
      },
    },
    filters: {
      mailto: function (value) {
        if (!value) return ''

        return 'mailto:' + value
      }
    }
  }
</script>
