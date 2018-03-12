<div class="panel panel-default">
  <form
    id="call-filter"
    class="panel-heading form-horizontal clearfix"
    role="search"
    action="{{ route('filter_client') }}"
    method="get"
    v-cloak>
    {{ csrf_field() }}
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12{{ $errors->has('filter_for') ? ' has-error' : ''}}">
      <label for="date" class="form-label">Filtrar por: </label>

      <select
        name="filter_for"
        id="filter_for"
        class="form-control input-sm"
        required
        autofocus
        v-model="filter">
        <option value="" checked disabled>@lang('shared.choose_an_option')</option>
        <option value="first_name">@lang('client.first_name')</option>
        <option value="last_name">@lang('client.last_name')</option>
        <option value="phone_1">@lang('client.phone') 1</option>
        <option value="phone_2">@lang('client.phone') 2</option>
        <option value="business">@lang('client.business')</option>
        <option value="email_1">@lang('client.email') 1</option>
        <option value="email_2">@lang('client.email') 2</option>
        <option value="reference">@lang('client.reference')</option>
      </select>
    </div>

    <div
      class="form-group col-xs-9 col-s10-5 col-md-10 col-lg-3"
      v-if="filter === 'first_name'">{{-- First name --}}
      <label
        for="first_name"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.first_name')
      </label>
      
      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="first_name"
          autocomplete="name"
          placeholder="@lang('client.first_name')"
          required>
      </div>
    </div>

    <div
      class="form-group col-xs-9 col-sm-10 col-md-10 col-lg-3"
      v-if="filter === 'last_name'">{{-- Last name --}}
      <label
        for="last_name"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.last_name')
      </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="last_name"
          autocomplete="additional-name"
          placeholder="@lang('client.last_name')"
          required>
      </div>
    </div>

    <div
      class="form-group col-xs-9 col-sm-10 col-md-10 col-lg-3"
      v-if="filter === 'phone_1'">{{-- Phone 1 --}}
      <label
        for="phone_1"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.phone') 1
      </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="tel"
          class="form-control input-sm"
          name="phone_1"
          autocomplete="tel-local"
          placeholder="@lang('client.phone') 1"
          required>
      </div>
    </div>

    <div
      class="form-group col-xs-9 col-sm-10 col-md-10 col-lg-3"
      v-if="filter === 'phone_2'">{{-- Phone 2 --}}
      <label
        for="phone_2"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.phone') 2
      </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="tel"
          class="form-control input-sm"
          name="phone_2"
          autocomplete="tel-local"
          placeholder="@lang('client.phone') 2"
          required>
      </div>
    </div>

    <div
      class="form-group col-xs-9 col-sm-10 col-md-10 col-lg-3"
      v-if="filter === 'business'">{{-- Business --}}
      <label
        for="business"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.business')
      </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="business"
          placeholder="@lang('client.business')"
          required>
      </div>
    </div>

    <div
      class="form-group col-xs-9 col-sm-10 col-md-10 col-lg-3"
      v-if="filter === 'email_1'">{{-- Email 1 --}}
      <label
        for="email_1"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.email') 1
      </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="email"
          class="form-control input-sm"
          name="email_1"
          autocomplete="email"
          placeholder="@lang('client.email') 1"
          required>
      </div>
    </div>

    <div
      class="form-group col-xs-9 col-sm-10 col-md-10 col-lg-3"
      v-if="filter === 'email_2'">{{-- Email 2 --}}
      <label
        for="email_2"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.email') 2
      </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="email"
          class="form-control input-sm"
          name="email_2"
          autocomplete="email"
          placeholder="@lang('client.email') 2"
          required>
      </div>
    </div>

    <div
      class="form-group col-xs-9 col-sm-10 col-md-10 col-lg-3"
      v-if="filter === 'reference'">{{-- Reference --}}
      <label
        for="reference"
        class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        @lang('client.reference')
      </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <input
          type="text"
          class="form-control input-sm"
          name="reference"
          placeholder="@lang('client.reference')"
          required>
      </div>
    </div>

    <div class="form-group col-xs-3 col-sm-2 col-md-2 col-lg-2">
      <button type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-search"></span> Buscar</button>
    </div>

    @if ($errors->has('filter_for'))
      <span class="help-block">
        <strong>{{ $errors->first('filter_for') }}</strong>
      </span>
    @endif
  </form>
</div>
