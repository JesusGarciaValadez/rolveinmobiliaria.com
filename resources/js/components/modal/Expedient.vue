<template>
  <div
    class="modal-dialog"
    role="document">
    <form
      class="form-horizontal modal-content"
      id="expedient-info"
      :action="route"
      method="post">
      <input type="hidden" name="_token" :value="csrf">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('call.new_expedient') }}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-xs-12">
            <label
              for="client_id"
              class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">{{ trans('call.internal_expedient_key') }}:
            </label>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 control-label">
              <select
                class="form-control"
                name="expedient_key"
                v-model="client.expedient.key">
                <option
                  value=""
                  checked
                  disabled
                >{{ trans('shared.choose_an_option') }}</option>
                <option value="VNT">VNT</option>
                <option value="RNT">RNT</option>
                <option value="CEX">CEX</option>
                <option value="JRD">JRD</option>
                <option value="AVA">AVA</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-xs-12">
            <label
              for="client_id"
              class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">{{ trans('call.internal_expedient_number') }}: </label>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 control-label">
              <input
                type="text"
                class="form-control"
                name="expedient_number"
                v-model="client.expedient.number"
                :placeholder="trans('call.internal_expedient_number')"
                autocorrect="on"
                size="2">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-xs-12">
            <label
              for="client_id"
              class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">{{ trans('call.internal_expedient_year') }}: </label>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 control-label">
              <input
                type="number"
                min="00"
                max="99"
                class="form-control"
                name="expedient_year"
                v-model="client.expedient.year"
                :placeholder="trans('call.internal_expedient_year')"
                autocorrect="on">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-xs-12">
            <label
              for="client_id"
              class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">{{ trans('call.client') }}: </label>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <select
                class="form-control"
                id="client_id"
                name="client_id"
                v-model="client.id"
                autofocus
                @change="getClientInfo">
                <option
                  value=""
                  selected
                  disabled>{{ trans('shared.choose_an_option') }}</option>
                <option
                  :value="client.id"
                  v-for="(client, key, index) in clients"
                  :key="key">{{ client.last_name }} {{ client.first_name }}</option>
              </select>
            </div>
          </div>
        </div>
        <create-new-client-link :message="this.message"></create-new-client-link>
        <div class="row">
          <spinner v-if="loading"></spinner>
          <div class="clearfix block col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-3 col-lg-8 col-lg-offset-2 alert alert-info" v-if="!loading && !empty">
            <client :initialClient="client"></client>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</template>

<script>
  import client from '../../mixins/client'

  export default{
    name: 'modal-expedient',
    children: ['client', 'spinner'],
    mixins: [client],
    props: {
      route: {
        required: true,
        default: '',
        type: String,
      },
      csrf: {
        required: true,
        default: '',
        type: String,
      },
      initialClients: {
        required: true,
        default: "",
        type: String,
      },
      internal_expedient_id: {
        required: false,
        default: null,
        type: String,
      },
      message: {
        type: String,
        required: true,
        default: ''
      }
    },
    data() {
      return {
        clients: null,
      }
    },
    mounted() {
      if (this.internal_expedient_id !== null) {
        this.empty = false
        this.getExpedientInfo()
      }

      if (this.initialClients) {
        this.clients = JSON.parse(this.initialClients)
      }
    }
  }
</script>
