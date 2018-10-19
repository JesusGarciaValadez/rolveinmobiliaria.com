@extends('layouts.app')

@section('title', "Nuevo | " . __('section.call'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading([
          'route' => route('call.index'),
          'routeTitle' => __('section.call'),
          'title' => __('call.new_call'),
        ])
        @endpanelHeading

        <div
          class="panel-body table-responsive"
          v-cloak>
          @alert([
            'type' => session('type'),
            'message' => session('message')
          ])
          @endalert

          <form
            class="form-horizontal"
            action="{{ route('call.store') }}"
            method="post">
            @csrf

            <div class="form-group{{ $errors->has('type_of_operation') ? ' has-error' : ''}}">
              <label
                for="type_of_operation"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.type_of_operation'): </label>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
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

            <select-internal-expedient
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
