@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-8 col-md-7 col-lg-6">
            <a href="{{ url()->previous() }}" title="@lang('section.call_tracking')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('shared.edit') @lang('call.call')
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <form class="form-horizontal" action="{{ route('update_call', ['id' => request('id')]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="user_id" value="{{ $call->user_id }}">

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

            <div class="form-group{{ $errors->has('client') ? ' has-error' : ''}}">
              <label
                for="client"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.client'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="client"
                  id="client"
                  value="{{ old('client') ? old('client') : $call->client }}"
                  placeholder="@lang('call.clients_name')"
                  required
                  autocorrect="on">

                  @if ($errors->has('client'))
                    <span class="help-block">
                      <strong>{{ $errors->first('client') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('client_phone_1') ? ' has-error' : ''}}">
              <label
                for="client_phone_1"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.phone') 1: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="client_phone_1"
                  id="client_phone_1"
                  value="{{ old('client_phone_1') ? old('client_phone_1') : $call->client_phone_1 }}"
                  placeholder="@lang('call.phone') 1"
                  required
                  autocorrect="on">

                  @if ($errors->has('client_phone_1'))
                    <span class="help-block">
                      <strong>{{ $errors->first('client_phone_1') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('client_phone_2') ? ' has-error' : ''}}">
              <label
                for="client_phone_2"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.phone') 2: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="client_phone_2"
                  id="client_phone_2"
                  value="{{ old('client_phone_2') ? old('client_phone_2') : $call->client_phone_2 }}"
                  placeholder="@lang('call.phone') 2"
                  autocorrect="on">

                  @if ($errors->has('client_phone_2'))
                    <span class="help-block">
                      <strong>{{ $errors->first('client_phone_2') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
              <label
                for="email"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.email'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  value="{{ old('email') ? old('email') : $call->email }}"
                  placeholder="@lang('call.email')"
                  autocorrect="on">

                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
              <label
                for="addess"
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
              <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">
                <label class="radio-inline">
                  <input
                    type="radio"
                    name="status"
                    id="client_1"
                    value="Abierto"
                    {{ (old('status') == 'Abierto' ||
                        $call->status == 'Abierto')
                          ? 'checked'
                          : '' }}> @lang('shared.open')
                </label>
                <label class="radio-inline">
                  <input
                    type="radio"
                    name="status"
                    id="client_2"
                    value="Cerrado"
                    {{ (old('status') == 'Cerrado' ||
                        $call->status == 'Cerrado')
                          ? 'checked'
                          : '' }}> @lang('shared.closed')
                </label>

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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.state_of_the_republic'): </label>
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

            <div class="form-group">
              @include('call.partials.buttons.save')

              @include('call.partials.buttons.back', ['back' => route('call_trackings')])
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
