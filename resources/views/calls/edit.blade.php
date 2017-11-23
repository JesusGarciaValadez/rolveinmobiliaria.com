@extends('layouts.app')

@section('title', __('shared.edit')." | ".__('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-8 col-md-7 col-lg-6">
            <a href="{{ route('call_trackings') }}" title="@lang('section.call_tracking')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('shared.edit') @lang('call.call')
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <form
            class="form-horizontal"
            id="client-info"
            action="{{ route('update_call', ['id' => request('id')]) }}"
            method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="user_id" value="{{ $call->user_id }}">

            <div class="form-group{{ $errors->has('type_of_operation') ? ' has-error' : ''}}">
              <label
                for="type_of_operation"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('shared.type_of_operation'): </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
                <select
                  class="form-control"
                  id="type_of_operation"
                  name="type_of_operation"
                  required
                  autofocus>
                  <option
                    value=""
                    {{ (!old('type_of_operation')) ? 'selected' : '' }}>@lang('call.choose_an_option')</option>
                  <option
                    value="Venta"
                    {{ (old('type_of_operation') == 'Venta'
                    || $call->type_of_operation == 'Venta')
                        ? 'selected'
                        : '' }}>@lang('call.sale')</option>
                  <option
                    value="Renta"
                    {{ (old('type_of_operation') == 'Renta'
                    || $call->type_of_operation == 'Renta')
                        ? 'selected'
                        : '' }}>@lang('call.rent')</option>
                  <option
                    value="Contratos de exclusividad"
                    {{ (old('type_of_operation') == 'Contratos de exclusividad'
                    || $call->type_of_operation == 'Contratos de exclusividad')
                        ? 'selected'
                        : '' }}>@lang('call.exclusive_contracts')</option>
                  <option
                    value="Jurídico"
                    {{ (old('type_of_operation') == 'Jurídico'
                    || $call->type_of_operation == 'Jurídico')
                        ? 'selected'
                        : '' }}>@lang('call.legal')</option>
                  <option
                    value="Avalúos"
                    {{ (old('type_of_operation') == 'Avalúos'
                    || $call->type_of_operation == 'Avalúos')
                      ? 'selected'
                      : '' }}>@lang('call.appraisals')</option>
                  <option
                    value="Recados"
                    {{ (old('type_of_operation') == 'Recados'
                    || $call->type_of_operation == 'Recados')
                      ? 'selected'
                      : '' }}>@lang('call.messages')</option>
                </select>

                @if ($errors->has('type_of_operation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('type_of_operation') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('expedient') ? ' has-error' : ''}}">
              <label
                for="expedient"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.internal_expedient'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="expedient"
                  id="expedient"
                  value="{{ (old('expedient'))
                    ? old('expedient')
                    : $call->expedient }}"
                  placeholder="@lang('call.internal_expedient')"
                  autocorrect="on"
                  required>

                  @if ($errors->has('expedient'))
                    <span class="help-block">
                      <strong>{{ $errors->first('expedient') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('client_id') ? ' has-error' : ''}}">
              <label
                for="client_id"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.client'): </label>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <select
                  class="form-control"
                  id="client_id"
                  name="client_id"
                  required
                  autofocus
                  @change="getClientInfo">
                  <option
                    value=""
                    @if (!old('client_id'))
                      selected
                    @endif>
                    @lang('call.choose_an_option')</option>
                  @foreach ($clients as $client)
                    <option
                      value="{{ $client->id }}"
                      {{ ($client->id == $call->client->id) ||
                         (old('client_id') == $client->id)
                            ? 'selected'
                            : ''}}>{{ $client->full_name }}</option>
                  @endforeach
                </select>

                @if ($errors->has('client_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('client_id') }}</strong>
                  </span>
                @endif
              </div>
              <p class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8" v-show="!hasClient">
                ¿No encuentras al cliente?
                <a
                  href="#"
                  title="¡Crealo!"
                  target="_self"
                  data-toggle="modal"
                  data-target="#newClient">¡Crealo!</a>
              </p>
            </div>

            <Spinner v-if="loading"></Spinner>
            <Client
              :phone-one="clientPhoneOne"
              :phone-two="clientPhoneTwo"
              :business="clientBusiness"
              :email="clientEmail"
              :reference="clientReference"
              :has-client="hasClient"
              v-if="!loading"></Client>

            <div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
              <label
                for="address"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.property_address'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="address"
                  value="{{ old('address') ? old('address') : $call->address }}"
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
                    @if (!old('state_id'))
                      selected
                    @endif>@lang('call.choose_a_state')</option>
                  @foreach ( $states as $state )
                    <option
                      value="{{ $state->id }}"
                      {{ (old('state_id') == $state->id || $call->state_id == $state->id)
                          ? 'selected'
                          : ''}}>
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
                  rows="8"
                  required
                  autocorrect="on">{{ old('observations') ? old('observations') : $call->observations }}</textarea>

                  @if ($errors->has('observations'))
                    <span class="help-block">
                      <strong>{{ $errors->first('observations') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
              <label
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.status'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="status"
                  value="{{ old('status') ? old('status') : $call->status }}"
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
                  <option
                    value="Baja"
                    {{ (old('priority') == 'Baja' ||
                        $call->priority == 'Baja')
                          ? 'selected'
                          : ''}}>@lang('shared.low')
                  </option>
                  <option
                    value="Media"
                    {{ (old('priority') == 'Media' ||
                        $call->priority == 'Media')
                          ? 'selected'
                          : ''}}>@lang('shared.medium')
                  </option>
                  <option
                    value="Alta"
                    {{ (old('priority') == 'Alta' ||
                        $call->priority == 'Alta')
                          ? 'selected'
                          : ''}}>@lang('shared.hight')
                  </option>
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
                  <h4 class="modal-title">Agregar cliente nuevo</h4>
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

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                    <label
                    for="email"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('call.email'): </label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                      <input
                      type="email"
                      class="form-control"
                      name="email"
                      value="{{ old('email') }}"
                      placeholder="@lang('call.email')"
                      autocorrect="on">

                      @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
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
