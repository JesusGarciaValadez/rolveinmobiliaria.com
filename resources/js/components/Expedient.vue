<template>
  <div class="row" v-if="!isEmpty">
    <div class="clearfix block col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-2 col-md-9 col-lg-offset-2 col-lg-10 alert alert-info">
      <div>
        <p v-show="hasExpedient"><strong>{{ trans('sale.internal_expedient') }}:</strong> {{ expedientComposed }}</p>
      </div>

      <client
        :initialClient="initialClient"
        v-if="hasClient"
      ></client>
      <create-new-client-link message="¿No existe el cliente?"></create-new-client-link>
    </div>
  </div>
</template>

<script>
  import client from '../mixins/client'
  import CreateNewClientLink from './CreateNewClientLink'

  export default {
    name: 'Expedient',
    components: {CreateNewClientLink},
    mixins: [client],
    props: ['initialClient', 'isEmpty'],
    computed: {
      hasExpedient: function () {
        return (
          this.client.expedient.key !== '' &&
          this.client.expedient.number !== '' &&
          this.client.expedient.year !== ''
        )
      },
    },
  }
</script>
