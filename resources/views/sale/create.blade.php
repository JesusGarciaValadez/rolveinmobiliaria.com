@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-8 col-md-7 col-lg-6">
            <a
              href="{{ url()->previous() }}"
              title="@lang('section.for_sale')"
              class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('sale.new_sale')</h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <form
            class="form-horizontal"
            action="{{ route('store_sale') }}"
            method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('type_of_operation') ? ' has-error' : ''}}">
              <label
                for="type_of_operation"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.type_of_operation'): </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
                <select
                  class="form-control"
                  id="type_of_operation"
                  name="type_of_operation"
                  required
                  autofocus>
                  <option
                    value=""
                    selected>
                    @lang('sale.choose_an_option')</option>
                  <option
                    value="Venta"
                    @if (old('type_of_operation') == "Venta")
                      selected
                    @endif>@lang('sale.sale')</option>
                  <option
                    value="Renta"
                    @if (old('type_of_operation') == "Renta")
                      selected
                    @endif>@lang('sale.rent')</option>
                  <option
                    value="Contratos de exclusividad"
                    @if (old('type_of_operation') == "Contratos de exclusividad")
                      selected
                    @endif>@lang('sale.exclusive_contracts')</option>
                  <option
                    value="Jurídico"
                    @if (old('type_of_operation') == "Jurídico")
                      selected
                    @endif>@lang('sale.legal')</option>
                  <option
                    value="Avalúos"
                    @if (old('type_of_operation') == "Avalúos")
                      selected
                    @endif>@lang('sale.appraisals')</option>
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
                for="expedient_phone_1"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.internal_expedient'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="expedient"
                  id="expedient"
                  value="{{ old('expedient') }}"
                  placeholder="@lang('sale.internal_expedient')"
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.client'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="text"
                  class="form-control"
                  name="client"
                  id="client"
                  value="{{ old('client') }}"
                  placeholder="@lang('sale.clients_name')"
                  autocorrect="on"
                  required>

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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.phone') 1: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="client_phone_1"
                  id="client_phone_1"
                  value="{{ old('client_phone_1') }}"
                  placeholder="@lang('sale.phone') 1"
                  autocorrect="on"
                  required>

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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.phone') 2: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="client_phone_2"
                  id="client_phone_2"
                  value="{{ old('client_phone_2') }}"
                  placeholder="@lang('sale.phone') 2"
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.email'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="@lang('sale.email')"
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
                for="address"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.property_address'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="address"
                  value="{{ old('address') }}"
                  placeholder="@lang('sale.property_address')"
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.state_of_the_republic'): </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2 control-label">
                <select
                  class="form-control"
                  name="state_id"
                  id="state_id">
                  <option
                    value=""
                    @if (old('state_id'))
                      selected
                    @endif>@lang('sale.choose_a_state')</option>
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.observations'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <textarea
                  class="form-control"
                  name="observations"
                  id="observations"
                  placeholder="@lang('sale.observations')"
                  value="{{ old('observations') }}"
                  rows="8"
                  required
                  autocorrect="on"></textarea>

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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.status'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="status"
                  value="{{ old('status') }}"
                  placeholder="@lang('sale.status')"
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.priority'): </label>
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
              <div class="form-group">
                @include('call.partials.buttons.save')
              </div>

              <div class="form-group">
                @include('call.partials.buttons.back', [
                'back' => route('call_trackings')
                ])
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
