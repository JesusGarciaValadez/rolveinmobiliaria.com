<template>
  <form
    class="panel-heading form-horizontal clearfix"
    role="search"
    :action="route"
    method="get"
    v-cloak
  >
    <input type="hidden" name="_token" :value="csrf">

    <div :class="['form-group', errors['filter_by'] ? ' has-error' : '' ]">
      <label
        for="date"
        class="form-label col-xs-12 col-sm-2 col-md-2 col-lg-2">Filtrar por: </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <select
          name="filter_by"
          id="filter_by"
          class="form-control input-sm"
          required
          autofocus
          v-model="filter_by">
          <option
            value=""
            selected
            disabled>{{ trans('shared.choose_an_option') }}</option>
          <option value="first_name">{{ trans('client.first_name') }}</option>
          <option value="last_name">{{ trans('client.last_name') }}</option>
          <option value="phone_1">{{ trans('client.phone') }} 1</option>
          <option value="phone_2">{{ trans('client.phone') }} 2</option>
          <option value="business">{{ trans('client.business') }}</option>
          <option value="email_1">{{ trans('client.email') }} 1</option>
          <option value="email_2">{{ trans('client.email') }} 2</option>
          <option value="reference">{{ trans('client.reference') }}</option>
        </select>
      </div>
    </div>

    <div
      class="form-group"
       v-if="filter_by === 'first_name'">
      <label
        for="first_name"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.first_name') }}</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="first_name"
          id="first_name"
          autocomplete="name"
          :placeholder="trans('client.first_name')"
          required
          v-model="value">
      </div>
    </div>

    <div
      class="form-group"
      v-if="filter_by === 'last_name'">
      <label
        for="last_name"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.last_name') }}</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="last_name"
          id="last_name"
          autocomplete="additional-name"
          :placeholder="trans('client.last_name')"
          required
          v-model="value">
      </div>
    </div>

    <div
      class="form-group"
      v-if="filter_by === 'phone_1'">
      <label
        for="phone_1"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.phone') }} 1</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="tel"
          class="form-control input-sm"
          name="phone_1"
          id="phone_1"
          autocomplete="tel-local"
          :placeholder="trans('client.phone')"
          required
          v-model="value">
      </div>
    </div>

    <div
      class="form-group"
      v-if="filter_by === 'phone_2'">
      <label
        for="phone_2"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.phone') }} 2</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="tel"
          class="form-control input-sm"
          name="phone_2"
          id="phone_2"
          autocomplete="tel-local"
          :placeholder="trans('client.phone')"
          required
          v-model="value">
      </div>
    </div>

    <div
      class="form-group"
      v-if="filter_by === 'business'">
      <label
        for="business"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.business') }}</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="business"
          id="business"
          autocomplete="organization"
          :placeholder="trans('client.business')"
          required
          v-model="value">
      </div>
    </div>

    <div
      class="form-group"
      v-if="filter_by === 'email_1'">
      <label
        for="email_1"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.email') }} 1</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="email"
          class="form-control input-sm"
          name="email_1"
          id="email_1"
          autocomplete="email"
          :placeholder="trans('client.email')"
          required
          v-model="value">
      </div>
    </div>

    <div
      class="form-group"
      v-if="filter_by === 'email_2'">
      <label
        for="email_2"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.email') }} 2</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="email"
          class="form-control input-sm"
          name="email_2"
          id="email_2"
          autocomplete="email"
          :placeholder="trans('client.email')"
          required
          v-model="value">
      </div>
    </div>

    <div
      class="form-group"
      v-if="filter_by === 'reference'">
      <label
        for="reference"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">{{ trans('client.reference') }}</label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="reference"
          id="reference"
          :placeholder="trans('client.reference')"
          required
          v-model="value">
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
      <button type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-search"></span> Buscar</button>
    </div>

    <span class="help-block" v-if="errors['filter_by_for']">
      <strong>{{ errors['filter_by_for'] }}</strong>
    </span>
  </form>
</template>

<script>
export default {
  name: "client-filter",
  props: {
    route: {
      type: String,
      default: "",
      required: true
    },
    csrf: {
      type: String,
      default: "",
      required: true
    },
    initialFilterBy: {
      type: String,
      default: "",
      required: false
    },
    initialValue: {
      type: String,
      default: "",
      required: false
    },
    errors: {
      type: String,
      default: null,
      require: false
    }
  },
  data() {
    return {
      filter_by: "",
      value: ""
    };
  },
  created: function() {
    if (this.initialValue) {
      this.value = this.initialValue;
    }

    if (this.initialFilterBy) {
      this.filter_by = this.initialFilterBy;
    }
  }
};
</script>
