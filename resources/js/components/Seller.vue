<template>
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title">{{ trans('sale.sellers') }}</h4>
    </div>
    <div class="panel-body">
      <fieldset>
        <input type="hidden" name="id" :value="sale.seller.ID" v-if="sale.seller.ID">

        <select-internal-expedient
          :expedient-selected="internal_expedient.id"
          :initial-expedients="initialExpedients"
          :initial-clients="initialClients"
          :errors="errors"
        ></select-internal-expedient>

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_deed ? ' has-error' : ''
          ]">
          <label
            for="SD_deed"
            class="checkbox-inline control-label">
            <input
              name="SD_deed"
              id="SD_deed"
              type="checkbox"
              v-model="sale.seller.deed">{{ trans('sale.sellers_deed') }}
          </label>

          <span class="help-block" v-if="errors.SD_deed">
            <strong>{{ errors.SD_deed }}</strong>
          </span>
        </div><!-- SD_deed -->

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_water ? ' has-error' : ''
          ]">
          <label
            for="SD_water"
            class="checkbox-inline control-label">
            <input
              name="SD_water"
              id="SD_water"
              type="checkbox"
              v-model="sale.seller.water">{{ trans('sale.sellers_water') }}
          </label>

          <span class="help-block" v-if="errors.SD_water">
            <strong>{{ errors.SD_water }}</strong>
          </span>
        </div><!-- SD_water -->

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_predial ? ' has-error' : ''
          ]">
          <label
            for="SD_predial"
            class="checkbox-inline control-label">
            <input
              name="SD_predial"
              id="SD_predial"
              type="checkbox"
              v-model="sale.seller.predial">{{ trans('sale.sellers_predial') }}
          </label>

          <span class="help-block" v-if="errors.SD_predial">
            <strong>{{ errors.SD_predial }}</strong>
          </span>
        </div><!-- SD_predial -->

        <div
          :class="[
          'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
          errors.SD_light ? ' has-error' : ''
        ]">
          <label
            for="SD_light"
            class="checkbox-inline control-label">
            <input
              name="SD_light"
              id="SD_light"
              type="checkbox"
              v-model="sale.seller.light">{{ trans('sale.sellers_light') }}
          </label>

          <span class="help-block" v-if="errors.SD_light">
            <strong>{{ errors.SD_light }}</strong>
          </span>
        </div><!-- SD_light -->

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_birth_certificate ? ' has-error' : ''
          ]">
          <label
            for="SD_birth_certificate"
            class="checkbox-inline control-label">
            <input
              name="SD_birth_certificate"
              id="SD_birth_certificate"
              type="checkbox"
              v-model="sale.seller.birth_certificate">{{ trans('sale.sellers_birth_certificate') }}
          </label>

          <span class="help-block" v-if="errors.SD_birth_certificate ">
            <strong>{{ errors.SD_birth_certificate }}</strong>
          </span>
        </div><!-- SD_birth_certificate -->

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_ID ? ' has-error' : ''
          ]">
          <label
            for="SD_ID"
            class="checkbox-inline control-label">
            <input
              name="SD_ID"
              id="SD_ID"
              type="checkbox"
              v-model="sale.seller.ID">{{ trans('sale.sellers_id')}}
          </label>

          <span class="help-block" v-if="errors.SD_ID">
            <strong>{{ errors.SD_ID }}</strong>
          </span>
        </div><!-- SD_ID -->

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_account_status ? ' has-error' : ''
          ]">
          <label
            for="SD_account_status"
            class="checkbox-inline control-label">
            <input
              name="SD_account_status"
              id="SD_account_status"
              type="checkbox"
              v-model="sale.seller.account_status">{{ trans('sale.sellers_account_status') }}
          </label>

          <span class="help-block" v-if="errors.SD_account_status">
            <strong>{{ errors.SD_account_status }}</strong>
          </span>
        </div><!-- SD_account_status -->

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_email ? ' has-error' : ''
          ]">
          <label
            for="SD_email"
            class="checkbox-inline control-label">
            <input
              name="SD_email"
              id="SD_email"
              type="checkbox"
              v-model="sale.seller.email">{{ trans('shared.email') }}
          </label>

          <span class="help-block" v-if="errors.SD_email">
            <strong>{{ errors.SD_email }}</strong>
          </span>
        </div><!-- SD_email -->

        <div
          :class="[
            'col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group',
            errors.SD_phone ? ' has-error' : ''
          ]">
          <label
            for="SD_phone"
            class="checkbox-inline control-label">
            <input
              name="SD_phone"
              id="SD_phone"
              type="checkbox"
              v-model="sale.seller.phone">{{ trans('shared.phone') }}
          </label>

          <span class="help-block" v-if="errors.SD_phone">
            <strong>{{ errors.SD_phone }}</strong>
          </span>
        </div><!-- SD_phone -->

        <div
          :class="[
            'col-xs-12 form-group',
            errors.SD_CURP ? ' has-error' : ''
          ]">
          <label
            for="SD_CURP"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-1">{{ trans('sale.sellers_curp') }}
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
            <input
              name="SD_CURP"
              id="SD_CURP"
              class="form-control"
              type="text"
              placeholder="CURP"
              v-model="sale.seller.CURP">
          </div>

          <span class="help-block" v-if="errors.SD_CURP">
            <strong>{{ errors.SD_CURP }}</strong>
          </span>
        </div><!-- SD_CURP -->

        <div
          :class="[
            'col-xs-12 form-group',
            errors.SD_RFC ? ' has-error' : ''
          ]">
          <label
            for="SD_RFC"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-1">{{ trans('sale.sellers_rfc') }}
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
            <input
              name="SD_RFC"
              id="SD_RFC"
              class="form-control"
              type="text"
              placeholder="RFC"
              v-model="sale.seller.RFC">
          </div>

          <span class="help-block" v-if="errors.SD_RFC">
            <strong>{{ errors.SD_RFC }}</strong>
          </span>
        </div><!-- SD_RFC -->

        <div
          :class="[
            'col-xs-12 form-group',
            errors.SD_civil_status ? ' has-error' : ''
          ]">
          <label
            for="SD_civil_status"
            class="col-xs-12 col-sm-12 col-md-2 col-lg-2 control-label">{{ trans('sale.sellers_civil_status') }}:</label>
          <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <select
              class="form-control"
              name="SD_civil_status"
              id="SD_civil_status"
              autofocus
              v-model="sale.seller.civil_status">
              <option value="" disabled>{{ trans('shared.choose_an_option') }}</option>
              <option value="Soltero">{{ trans('sale.sellers_single') }}</option>
              <option value="Casado">{{ trans('sale.sellers_married') }}</option>
            </select>

            <span class="help-block" v-if="errors.SD_civil_status">
              <strong>{{ errors.SD_civil_status  }}</strong>
            </span>
          </div>
        </div><!-- SD_civil_status -->
      </fieldset>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Seller",
    props: {
      initialClients: {
        type: String,
        required: false,
      },
      initialExpedients: {
        type: String,
        required: false,
      },
      initialSale: {
        type: String,
        required: false
      },
      errors: {
        type: String,
        required: false,
      }
    },
    data() {
      return {
        sale: {
          seller: {
            deed: false,
            water: false,
            predial: false,
            light: false,
            birth_certificate: false,
            ID: false,
            CURP: '',
            RFC: '',
            account_status: false,
            email: false,
            phone: false,
            civil_status: ''
          },
        },
        internal_expedient: {
          id: '',
        }
      }
    },
    computed: {
      sellerIsComplete () {
        return (
          this.sale.seller.deed ||
          this.sale.seller.water ||
          this.sale.seller.predial ||
          this.sale.seller.light ||
          this.sale.seller.birth_certificate ||
          this.sale.seller.ID ||
          this.sale.seller.CURP !== '' ||
          this.sale.seller.RFC !== '' ||
          this.sale.seller.account_status ||
          this.sale.seller.email ||
          this.sale.seller.phone ||
          this.sale.seller.civil_status !== ''
        )
      },
    },
    mounted: function () {
      if (this.initialSale) {
        const { seller, internal_expedient } = JSON.parse(this.initialSale)
        this.internal_expedient.id = internal_expedient.id
        this.sale.seller.deed = seller.SD_deed
        this.sale.seller.water = seller.SD_water
        this.sale.seller.predial = seller.SD_predial
        this.sale.seller.light = seller.SD_light
        this.sale.seller.birth_certificate = seller.SD_birth_certificate
        this.sale.seller.ID = seller.SD_ID
        this.sale.seller.CURP = seller.SD_CURP
        this.sale.seller.RFC = seller.SD_RFC
        this.sale.seller.account_status = seller.SD_account_status
        this.sale.seller.email = seller.SD_email
        this.sale.seller.phone = seller.SD_phone
        this.sale.seller.civil_status = seller.SD_civil_status
      }
    }
  }
</script>
