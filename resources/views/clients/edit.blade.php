@extends('layouts.app')

@section('title', "Editar | ".('section.for_sale'))

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
              <span
                class="glyphicon glyphicon-chevron-left"
                aria-hidden="true"></span>
            </a>
            @lang('shared.edit') @lang('client.client')
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <form
            class="form-horizontal"
            action="{{ route('update_client', ['id' => request('id')]) }}"
            method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
              <label
                for="name"
                class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-2 control-label">@lang('call.client'): </label>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  id="name"
                  value="{{ !empty(old('name'))
                    ? old('name')
                    : $client->name }}"
                  placeholder="@lang('call.clients_name')"
                  autocorrect="on"
                  required>

                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
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
                  value="{{ !empty(old('phone_1'))
                    ? old('phone_1')
                    : $client->phone_1 }}"
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
                  value="{{ !empty(old('phone_2'))
                    ? old('phone_2')
                    : $client->phone_2 }}"
                  placeholder="@lang('call.phone') 2"
                  autocorrect="on">

                @if ($errors->has('phone_2'))
                  <span class="help-block">
                    <strong>{{ $errors->first('phone_2') }}</strong>
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
                  value="{{ !empty(old('email'))
                    ? old('email')
                    : $client->email }}"
                  placeholder="@lang('call.email')"
                  autocorrect="on">

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-inline">
              <div class="form-group">
                @include('clients.partials.buttons.save')
              </div>

              <div class="form-group">
                @include('clients.partials.buttons.back', [
                'back' => route('clients')
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
