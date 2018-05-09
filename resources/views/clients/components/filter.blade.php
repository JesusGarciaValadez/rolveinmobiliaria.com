<div class="panel panel-default">
  <form
    id="call-filter"
    class="panel-heading form-horizontal clearfix"
    role="search"
    action="{{ route('filter_client') }}"
    method="get"
    v-cloak>
    @csrf
    <div class="form-group{{ $errors->has('filter_for') ? ' has-error' : ''}}">
      <label for="date" class="form-label col-xs-12 col-sm-2 col-md-2 col-lg-2">Filtrar por: </label>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <select
          name="filter_by"
          id="filter_by"
          class="form-control input-sm"
          required
          autofocus
          v-model="filter">
          <option
            value=""
            @if (request('filter_by') === null)
              selected
            @endif
            disabled>@lang('shared.choose_an_option')</option>
          <option
            value="first_name"
            @if (request('filter_by') === 'first_name')
              selected
            @endif>@lang('client.first_name')</option>
          <option
            value="last_name"
            @if (request('filter_by') === 'last_name')
              selected
            @endif>@lang('client.last_name')</option>
          <option
            value="phone_1"
            @if (request('filter_by') === 'phone_1')
              selected
            @endif>@lang('client.phone') 1</option>
          <option
            value="phone_2"
            @if (request('filter_by') === 'phone_2')
              selected
            @endif>@lang('client.phone') 2</option>
          <option
            value="business"
            @if (request('filter_by') === 'business')
              selected
            @endif>@lang('client.business')</option>
          <option
            value="email_1"
            @if (request('filter_by') === 'email_1')
              selected
            @endif>@lang('client.email') 1</option>
          <option
            value="email_2"
            @if (request('filter_by') === 'email_2')
              selected
            @endif>@lang('client.email') 2</option>
          <option
            value="reference"
            @if (request('filter_by') === 'reference')
              selected
            @endif>@lang('client.reference')</option>
        </select>
      </div>
    </div>

    <div
      class="form-group"
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
          id="first_name"
          autocomplete="name"
          placeholder="@lang('client.first_name')"
          @if (request('first_name') !== null)
            value="{{ request('first_name') }}"
          @endif
          required>
      </div>
    </div>

    <div
      class="form-group"
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
          id="last_name"
          autocomplete="additional-name"
          placeholder="@lang('client.last_name')"
          @if (request('last_name') !== null)
            value="{{ request('last_name') }}"
          @endif
          required>
      </div>
    </div>

    <div
      class="form-group"
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
          id="phone_1"
          autocomplete="tel-local"
          placeholder="@lang('client.phone') 1"
          @if (request('phone_1') !== null)
            value="{{ request('phone_1') }}"
          @endif
          required>
      </div>
    </div>

    <div
      class="form-group"
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
          id="phone_2"
          autocomplete="tel-local"
          placeholder="@lang('client.phone') 2"
          @if (request('phone_2') !== null)
            value="{{ request('phone_2') }}"
          @endif
          required>
      </div>
    </div>

    <div
      class="form-group"
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
          id="business"
          autocomplete="organization"
          placeholder="@lang('client.business')"
          @if (request('business') !== null)
            value="{{ request('business') }}"
          @endif
          required>
      </div>
    </div>

    <div
      class="form-group"
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
          id="email_1"
          autocomplete="email"
          placeholder="@lang('client.email') 1"
          @if (request('email_1') !== null)
            value="{{ request('email_1') }}"
          @endif
          required>
      </div>
    </div>

    <div
      class="form-group"
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
          id="email_2"
          autocomplete="email"
          placeholder="@lang('client.email') 2"
          @if (request('email_2') !== null)
            value="{{ request('email_2') }}"
          @endif
          required>
      </div>
    </div>

    <div
      class="form-group"
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
          id="reference"
          placeholder="@lang('client.reference')"
          @if (request('first_name') !== null)
            value="{{ request('reference') }}"
          @endif
          required>
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
      <button type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-search"></span> Buscar</button>
    </div>

    @if ($errors->has('filter_for'))
      <span class="help-block">
        <strong>{{ $errors->first('filter_for') }}</strong>
      </span>
    @endif
  </form>
</div>
