@extends('layouts.app')

@section('title', "Nuevo | " . __('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-8 col-md-7 col-lg-6">
            <a href="{{ route('call_trackings') }}" title="@lang('section.call_tracking')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('call.new_call')</h1>
        </div>

        <div class="panel-body table-responsive" id="client-info">
          @include('shared.partials.alerts.message')

          <form
            class="form-horizontal"
            action="{{ route('store_call') }}"
            method="post">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('type_of_operation') ? ' has-error' : ''}}">
              <label
                for="type_of_operation"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.type_of_operation'): </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
                <select
                  class="form-control"
                  id="type_of_operation"
                  name="type_of_operation"
                  required
                  autofocus>
                  <option
                    value=""
                    disabled
                    selected>
                    @lang('shared.choose_an_option')</option>
                  <option
                    value="Venta"
                    @if (old('type_of_operation') == "Venta")
                      selected
                    @endif>@lang('call.sale')</option>
                  <option
                    value="Renta"
                    @if (old('type_of_operation') == "Renta")
                      selected
                    @endif>@lang('call.rent')</option>
                  <option
                    value="Contratos de exclusividad"
                    @if (old('type_of_operation') == "Contratos de exclusividad")
                      selected
                    @endif>@lang('call.exclusive_contracts')</option>
                  <option
                    value="Jurídico"
                    @if (old('type_of_operation') == "Jurídico")
                      selected
                    @endif>@lang('call.legal')</option>
                  <option
                    value="Avalúos"
                    @if (old('type_of_operation') == "Avalúos")
                      selected
                    @endif>@lang('call.appraisals')</option>
                  <option
                    value="Recados"
                    @if (old('type_of_operation') == "Recados")
                      selected
                    @endif>@lang('call.messages')</option>
                </select>

                @if ($errors->has('type_of_operation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('type_of_operation') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('internal_expedient_id') ? ' has-error' : ''}}">
              <label
                for="expedient_id"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.internal_expedient'): </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
                <select
                  class="form-control"
                  id="internal_expedient_id"
                  name="internal_expedient_id"
                  autofocus
                  @change="getExpedientInfo">
                  <option
                    value=""
                    selected
                    disabled>
                    @lang('shared.choose_an_option')</option>
                  @foreach ($expedients as $expedient)
                    <option
                      value="{{ $expedient->id }}"
                      {{ (old('internal_expedient_id') === $expedient->id)
                          ? 'selected'
                          : ''}}>{{ $expedient->expedient }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="client_id" :value="clientId">
                <input type="hidden" name="expedient" :value="clientExpedient">

                @if ($errors->has('internal_expedient_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('internal_expedient_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="block row clearfix col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <p class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8" :has-expedient="hasExpedient">
                ¿No encuentras el expediente?
                <a
                href="#"
                title="¡Crealo!"
                target="_self"
                data-toggle="modal"
                data-target="#newExpedient">¡Crealo!</a>
              </p>
            </div>

            <Spinner v-if="loading"></Spinner>
            <Expedient
              :expedient="clientExpedient"
              :name="fullName"
              :phone-one="clientPhoneOne"
              :phone-two="clientPhoneTwo"
              :business="clientBusiness"
              :email-one="clientEmailOne"
              :email-two="clientEmailTwo"
              :reference="clientReference"
              :has-client="hasClient"
              :empty="empty"
              v-if="!loading"></Expedient>

            <div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
              <label
                for="address"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.property_address'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="address"
                  value="{{ old('address') }}"
                  placeholder="@lang('call.property_address')"
                  autocorrect="on">

                  @if ($errors->has('address'))
                    <span class="help-block">
                      <strong>{{ $errors->first('address') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('state_id') ? ' has-error' : ''}}">
              <label
                for="state_id"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.state_of_the_republic'): </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2 control-label">
                <select
                  class="form-control"
                  name="state_id"
                  id="state_id">
                  <option
                    value=""
                    disabled
                    @if (old('state_id'))
                      selected
                    @endif>@lang('call.choose_a_state')</option>
                  @foreach ( $states as $state )
                    <option
                      value="{{ $state->id }}"
                      @if (old('state_id') == $state->id || $state->id == '7')
                        selected
                      @endif>
                      {{ $state->name }}
                    </option>
                  @endforeach
                </select>

                @if ($errors->has('state_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('state_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('observations') ? ' has-error' : ''}}">
              <label
                for="observations"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.observations'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <textarea
                  class="form-control"
                  name="observations"
                  id="observations"
                  placeholder="@lang('call.observations')"
                  value="{{ old('observations') }}"
                  rows="8"
                  required
                  autocorrect="on">{{ old('observations') }}</textarea>

                  @if ($errors->has('observations'))
                    <span class="help-block">
                      <strong>{{ $errors->first('observations') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
              <label
                for="status"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.status'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="status"
                  value="{{ old('status') }}"
                  placeholder="@lang('call.status')"
                  autocorrect="on">

                  @if ($errors->has('status'))
                    <span class="help-block">
                      <strong>{{ $errors->first('status') }}</strong>
                    </span>
                  @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('priority') ? ' has-error' : ''}}">
              <label
                for="priority"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.priority'): </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2 control-label">
                <select
                  class="form-control"
                  name="priority"
                  id="priority"
                  required>
                  <option value="Baja">@lang('shared.low')</option>
                  <option value="Media" selected>@lang('shared.medium')</option>
                  <option value="Alta">@lang('shared.hight')</option>
                </select>

                @if ($errors->has('priority'))
                  <span class="help-block">
                    <strong>{{ $errors->first('priority') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-inline">
              @include('calls.partials.buttons.save')

              @include('calls.partials.buttons.back')
            </div>
          </form>

          <div
            class="modal fade bs-example-modal-lg"
            tabindex="-1"
            role="dialog"
            aria-labelledby="makeANewExpedient"
            id="newExpedient">
            <div class="modal-dialog modal-lg" role="document">
              <form
                class="form-horizontal modal-content"
                id="expedient-info"
                action="{{ route('store_internal_expedient') }}"
                method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">@lang('call.new_expedient')</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group{{ $errors->has('expedient') ? ' has-error' : ''}}">
                    <label
                      for="client_id"
                      class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.internal_expedient'): </label>
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                      <input
                        type="text"
                        class="form-control"
                        name="expedient"
                        value="{{ old('expedient') }}"
                        placeholder="@lang('call.internal_expedient')"
                        autocorrect="on">

                        @if ($errors->has('expedient'))
                          <span class="help-block">
                            <strong>{{ $errors->first('expedient') }}</strong>
                          </span>
                        @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('expedient_id') ? ' has-error' : ''}}">
                    <label
                      for="client_id"
                      class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.client'): </label>
                    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                      <select
                        class="form-control"
                        id="client_id"
                        name="client_id"
                        autofocus
                        @change="getClientInfo">
                        <option
                          value=""
                          selected
                          disabled>
                          @lang('shared.choose_an_option')</option>
                        @foreach ($clients as $client)
                          <option
                            value="{{ $client->id }}"
                            @if (old('client_id') == $client->id )
                              selected
                            @endif>{{ $client->full_name }}</option>
                        @endforeach
                      </select>

                      @if ($errors->has('client_id'))
                        <span class="help-block">
                          <strong>{{ $errors->first('client_id') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <Spinner v-if="loading"></Spinner>
                    <div class="clearfix block col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-3 col-lg-8 col-lg-offset-2 alert alert-info" v-if="hasClient">
                      <Client
                        :name="fullName"
                        :phone-one="clientPhoneOne"
                        :phone-two="clientPhoneTwo"
                        :business="clientBusiness"
                        :email-one="clientEmailOne"
                        :email-two="clientEmailTwo"
                        :reference="clientReference"
                        :empty="true"
                        :has-client="hasClient"></Client>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
              </form><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <div
            class="modal fade bs-example-modal-lg"
            tabindex="-1"
            role="dialog"
            aria-labelledby="makeANewClient"
            id="newClient">
            <div class="modal-dialog modal-lg" role="document">
              <form
                class="form-horizontal modal-content"
                action="{{ route('store_client') }}"
                method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">@lang('call.new_client')</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
                    <label
                    for="first_name"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.clients_first_name'): </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="text"
                      class="form-control"
                      name="first_name"
                      id="first_name"
                      value="{{ old('first_name') }}"
                      placeholder="@lang('call.clients_first_name')"
                      autocorrect="on"
                      required>

                      @if ($errors->has('first_name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('last_name') ? ' has-error' : ''}}">
                    <label
                    for="last_name"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.clients_last_name'): </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="text"
                      class="form-control"
                      name="last_name"
                      id="last_name"
                      value="{{ old('last_name') }}"
                      placeholder="@lang('call.clients_last_name')"
                      autocorrect="on"
                      required>

                      @if ($errors->has('last_name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('phone_1') ? ' has-error' : ''}}">
                    <label
                    for="phone_1"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.phone') 1: </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="tel"
                      class="form-control"
                      name="phone_1"
                      id="phone_1"
                      value="{{ old('phone_1') }}"
                      placeholder="@lang('call.phone') 1"
                      autocorrect="on"
                      required>

                      @if ($errors->has('phone_1'))
                        <span class="help-block">
                          <strong>{{ $errors->first('phone_1') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('phone_2') ? ' has-error' : ''}}">
                    <label
                    for="phone_2"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.phone') 2: </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="tel"
                      class="form-control"
                      name="phone_2"
                      id="phone_2"
                      value="{{ old('phone_2') }}"
                      placeholder="@lang('call.phone') 2"
                      autocorrect="on">

                      @if ($errors->has('phone_2'))
                        <span class="help-block">
                          <strong>{{ $errors->first('phone_2') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('business') ? ' has-error' : ''}}">
                    <label
                    for="business"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.clients_business'): </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="text"
                      class="form-control"
                      name="business"
                      id="business"
                      value="{{ old('business') }}"
                      placeholder="@lang('call.clients_business')"
                      autocorrect="on">

                      @if ($errors->has('business'))
                        <span class="help-block">
                          <strong>{{ $errors->first('business') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('email_1') ? ' has-error' : ''}}">
                    <label
                    for="email"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.email'): </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="email"
                      class="form-control"
                      name="email_1"
                      value="{{ old('email_1') }}"
                      placeholder="@lang('call.email')"
                      autocorrect="on">

                      @if ($errors->has('email_1'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email_1') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('email_2') ? ' has-error' : ''}}">
                    <label
                    for="email"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.email'): </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="email"
                      class="form-control"
                      name="email_2"
                      value="{{ old('email_2') }}"
                      placeholder="@lang('call.email')"
                      autocorrect="on">

                      @if ($errors->has('email_2'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email_2') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('reference') ? ' has-error' : ''}}">
                    <label
                    for="reference"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.clients_reference'): </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="text"
                      class="form-control"
                      name="reference"
                      id="reference"
                      value="{{ old('reference') }}"
                      placeholder="@lang('call.clients_reference')"
                      autocorrect="on">

                      @if ($errors->has('reference'))
                        <span class="help-block">
                          <strong>{{ $errors->first('reference') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
              </form><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
