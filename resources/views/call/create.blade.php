@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-8 col-md-7 col-lg-6">
            <a href="{{ url()->previous() }}" title="Seguimiento de llamadas" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            Nueva llamada</h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <form class="form-horizontal" action="{{ route('store_call') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('type_of_operation') ? ' has-error' : ''}}">
              <label
                for="type_of_operation"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">Tipo de operación: </label>
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
                    Escoge una opción</option>
                  <option
                    value="Venta"
                    @if (old('type_of_operation') == "Venta")
                      selected
                    @endif>Venta</option>
                  <option
                    value="Renta"
                    @if (old('type_of_operation') == "Renta")
                      selected
                    @endif>Renta</option>
                  <option
                    value="Regularización"
                    @if (old('type_of_operation') == "Regularización")
                      selected
                    @endif>Regularización</option>
                  <option
                    value="Jurídico"
                    @if (old('type_of_operation') == "Jurídico")
                      selected
                    @endif>Jurídico</option>
                  <option
                    value="Sucesión"
                    @if (old('type_of_operation') == "Sucesión")
                      selected
                    @endif>Sucesión</option>
                </select>

                @if ($errors->has('type_of_operation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('type_of_operation') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('client_phone_1') ? ' has-error' : ''}}">
              <label
                for="client_phone_1"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">Teléfono 1: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="client_phone_1"
                  id="client_phone_1"
                  value="{{ old('client_phone_1') }}"
                  placeholder="Teléfono 1"
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">Teléfono 2: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="tel"
                  class="form-control"
                  name="client_phone_2"
                  id="client_phone_2"
                  value="{{ old('client_phone_2') }}"
                  placeholder="Teléfono 2"
                  required
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">Email: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="Email"
                  required
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">Dirección del inmueble: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="address"
                  value="{{ old('address') }}"
                  placeholder="Dirección del inmueble"
                  required
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">Estado de la República: </label>
              <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2 control-label">
                <select
                  class="form-control"
                  name="state_id"
                  id="state_id"
                  required>
                  <option
                    value=""
                    @if (old('state_id'))
                      selected
                    @endif>Escoge un estado</option>
                  @foreach ( $states as $state )
                    <option
                      value="{{ $state->id }}"
                      @if (old('state_id') == $state->id)
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
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">Observaciones: </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <textarea
                  class="form-control"
                  name="observations"
                  id="observations"
                  placeholder="Observaciones"
                  value="{{ old('observations') }}"
                  rows="8"
                  autocorrect="on"></textarea>

                  @if ($errors->has('observations'))
                    <span class="help-block">
                      <strong>{{ $errors->first('observations') }}</strong>
                    </span>
                  @endif
              </div>
            </div>
            <div class="form-group">
              @include('call.partials.buttons.save')

              @include('call.partials.buttons.back')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
