<template>
  <div>
    <p><strong>Cliente: </strong> {{ name }}</p>
    <p v-show="hasPhoneOne"><strong>Teléfono:</strong> {{ initialClient.phoneOne }}</p>
    <p v-show="hasPhoneTwo"><strong>Teléfono:</strong> {{ initialClient.phoneTwo }}</p>
    <p v-show="hasBusiness"><strong>Empresa:</strong> {{ initialClient.business }}</p>
    <p v-show="hasEmailOne"><strong>Email:</strong> <a :href="initialClient.emailOne | mailto" :title="initialClient.emailOne">{{ initialClient.emailOne }}</a></p>
    <p v-show="hasEmailTwo"><strong>Email:</strong> <a :href="initialClient.emailTwo | mailto" :title="initialClient.emailTwo">{{ initialClient.emailTwo }}</a></p>
    <p v-show="hasReference"><strong>Referencia:</strong> {{ initialClient.reference }}</p>

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
  import client from '../mixins/client'

  export default {
    name: 'client',
    mixins: [client],
    props: {
      initialClient: {
        type: Object,
        default: {},
        required: true,
      },
    },
    computed: {
      name() {
        return `${this.initialClient.firstName} ${this.initialClient.lastName}`
      },
      hasPhoneOne() {
        return this.initialClient.phoneOne.length !== 0
      },
      hasPhoneTwo() {
        return this.initialClient.phoneTwo.length !== 0
      },
      hasBusiness() {
        return this.initialClient.business.length !== 0
      },
      hasEmailOne() {
        return this.initialClient.emailOne.length !== 0
      },
      hasEmailTwo() {
        return this.initialClient.emailTwo.length !== 0
      },
      hasReference() {
        return this.initialClient.reference.length !== 0
      },
    },
    filters: {
      mailto: function (value) {
        if (!value) return ''

        return 'mailto:' + value
      }
    },
  }
</script>
