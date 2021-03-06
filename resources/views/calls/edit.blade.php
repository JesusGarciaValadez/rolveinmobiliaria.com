@extends('layouts.app')

@section('title', __('shared.edit')." | ".__('section.call'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading([
          'route' => route('call.index'),
          'routeTitle' => __('section.call')
        ])
          @slot('title')
            @lang('shared.edit') @lang('call.call')
          @endslot
        @endpanelHeading

        <div class="panel-body table-responsive" id="call__info" v-cloak>
          @alert([
            'type' => session('type'),
            'message' => session('message')
          ])
          @endalert

          <form
            class="form-horizontal"
            action="{{ route('call.update', ['call' => request('call')]) }}"
            method="post">
            @csrf
            @method('PUT')

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
                    disabled
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

            <select-internal-expedient
              initial-expedient="{{ $call->internal_expedient->id }}"
              initial-expedients="{{ $expedients }}"
              initial-clients="{{ $clients }}"
              @if ($errors->has('internal_expedient_id'))
              errors="{{ $errors }}"
              @endif
            ></select-internal-expedient>

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
                  autocorrect="on"
                  autocomplete="street-address">

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
                  id="state_id"
                  autocomplete="address-level1">
                  <option
                    value=""
                    disabled
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
              @callsButtonSave
              @endcallsButtonSave

              @callsButtonBack
              @endcallsButtonBack
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('modals')
  @modalExpedient(['clients' => $clients])
  @endmodalExpedient

  @modalClient
  @endmodalClient
@endsection
