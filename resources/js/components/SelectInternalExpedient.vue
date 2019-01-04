<template>
  <div>
    <div
      :class="[
        'form-group',
        error.internal_expedient_id ? ' has-error' : ''
      ]"
    >
      <label
        for="expedient_id"
        class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">{{ trans('call.internal_expedient') }}:</label>
      <div class="col-xs-12 col-sm-9 col-md-6 col-lg-3">
        <select
          class="form-control"
          id="internal_expedient_id"
          name="internal_expedient_id"
          autofocus
          v-model="internalExpedient"
          @change="getExpedientInfo()">
          <option
            value=""
            selected
            disabled
          >{{ trans('shared.choose_an_option') }}</option>
          <option
            v-for="(expedient, key) in expedients"
            :value="expedient.id"
            :key="key"
          >{{ expedient.expedient_key }}/{{ expedient.expedient_number }}/{{ expedient.expedient_year }} - {{ expedient.client.first_name }} {{ expedient.client.last_name }}</option>
        </select>
        <input type="hidden" name="client_id" :value="client.id">
        <input type="hidden" name="expedient_key" :value="client.expedient.key">
        <input type="hidden" name="expedient_number" :value="client.expedient.number">
        <input type="hidden" name="expedient_year" :value="client.expedient.year">

        <span class="help-block" v-if="error.internal_expedient_id">
          <strong>{{ error.internal_expedient_id }}</strong>
        </span>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <p class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8" :has-expedient="hasExpedient">
        ¿No encuentras el expediente?
        <a
          href="#"
          title="¡Crealo!"
          target="_self"
          data-toggle="modal"
          data-target="#newExpedient">¡Crealo!
        </a>
      </p>
    </div>

    <spinner v-if="loading"></spinner>
    <expedient
      :initialClient="client"
      :isEmpty="empty"
      v-show="!loading && !empty"
    ></expedient>
  </div>
</template>

<script>
import client from "../mixins/client"

export default {
  name: 'SelectInternalExpedient',
  props: ['expedientSelected', 'initialExpedients', 'initialClients', 'errors'],
  mixins: [client],
  data: function () {
    return {
      internalExpedient: "",
      expedients: null,
      error: {
        internal_expedient_id: null
      }
    };
  },
  mounted: function () {
    console.log('Expedient: ', this.$props)
    if (this.expedient) {
      this.internalExpedient = this.expedientSelected

      this.getExpedientInfo(this.internalExpedient)
    }

    if (this.initialExpedients) {
      this.expedients = JSON.parse(this.initialExpedients)
    }

    if (this.errors) {
      this.error.internal_expedient_id = this.errors.internal_expedient_id;
    }
  }
};
</script>
