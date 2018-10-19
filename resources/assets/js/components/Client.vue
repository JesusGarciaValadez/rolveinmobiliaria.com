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
    data() {
      return {
        firstName: null,
        lastName: null,
        phoneOne: null,
        phoneTwo: null,
        business: null,
        emailOne: null,
        emailTwo: null,
        reference: null,
      }
    },
    computed: {
      name() {
        return `${this.firstName} ${this.lastName}`
      },
      hasPhoneOne() {
        return this.phoneOne.length !== 0
      },
      hasPhoneTwo() {
        return this.phoneTwo.length !== 0
      },
      hasBusiness() {
        return this.business.length !== 0
      },
      hasEmailOne() {
        return this.emailOne.length !== 0
      },
      hasEmailTwo() {
        return this.emailTwo.length !== 0
      },
      hasReference() {
        return this.reference.length !== 0
      },
    },
    filters: {
      mailto: function (value) {
        if (!value) return ''

        return 'mailto:' + value
      }
    },
    beforeMount() {
      if (this.initialClient) {
        const { firstName, lastName, phoneOne, phoneTwo, business, emailOne, emailTwo, reference } = this.initialClient
        this.firstName = firstName
        this.lastName = lastName
        this.phoneOne = phoneOne
        this.phoneTwo = phoneTwo
        this.business = business
        this.emailOne = emailOne
        this.emailTwo = emailTwo
        this.reference = reference
      }
    }
  }
</script>
