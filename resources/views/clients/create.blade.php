@extends('layouts.app')

@section('title', __('client.new_client'))

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
              title="@lang('section.client')"
              class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('client.new_client')
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <form
            class="form-horizontal"
            action="{{ route('store_client') }}"
            method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
              <label
              for="first_name"
              class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.clients_first_name'): </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                <input
                type="text"
                class="form-control"
                name="first_name"
                id="first_name"
                value="{{ old('name') }}"
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
              class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.clients_last_name'): </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                <input
                  type="text"
                  class="form-control"
                  name="last_name"
                  id="last_name"
                  value="{{ old('name') }}"
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
              class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.phone') 1: </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
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
              class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.phone') 2: </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
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
              class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.clients_business'): </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                <input
                  type="text"
                  class="form-control"
                  name="business"
                  id="business"
                  value="{{ old('name') }}"
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
              class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.email'): </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
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
              class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.clients_reference'): </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                <input
                  type="text"
                  class="form-control"
                  name="reference"
                  id="reference"
                  value="{{ old('name') }}"
                  placeholder="@lang('call.clients_reference')"
                  autocorrect="on">

                @if ($errors->has('reference'))
                  <span class="help-block">
                    <strong>{{ $errors->first('reference') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-inline">
              @include('clients.partials.buttons.save')

              @include('clients.partials.buttons.back', [
                'back' => route('clients')
              ])
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
