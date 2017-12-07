@extends('layouts.app')

@section('title', "Expediente ".$call->expedient."| ".__('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <a href="{{ url()->previous() }}" title="@lang('section.call_tracking')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.call_tracking')
          </h1>
          <h1 class="hidden-xs hidden-sm col-md-3 col-lg-2">
            <div class="pull-right text-right text-center">
              @include('calls.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h2>@lang('call.clients_information')</h2>
              <p class="text-left"><strong>@lang('call.client'):</strong> {{ $call->internal_expedient->client->full_name }}</p>

              <p class="text-left"><strong>@lang('call.phone'):</strong> {{ $call->internal_expedient->client->phone_1 }}</p>

              <p class="text-left"><strong>@lang('call.phone'):</strong> {{ $call->internal_expedient->client->phone_2 }}</p>

              <p class="text-left"><strong>@lang('call.email'):</strong>
                <a href="mailto:{{ $call->internal_expedient->client->email_1 }}" title="@lang('shared.send_email_to') {{ $call->internal_expedient->client->full_name }}" target="_blank">{{ $call->internal_expedient->client->email_1 }}</a>
              </p>

              <p class="text-left"><strong>@lang('call.email'):</strong>
                <a href="mailto:{{ $call->internal_expedient->client->email_2 }}" title="@lang('shared.send_email_to') {{ $call->internal_expedient->client->full_name }}" target="_blank">{{ $call->internal_expedient->client->email_2 }}</a>
              </p>

              <p class="text-left"><strong>@lang('call.address'):</strong> {{ $call->address }}</p>

              <p class="text-left"><strong>@lang('call.state'):</strong> {{ $call->state->name }}</p>

              <p class="text-left">
                <strong>@lang('call.internal_expedient'):</strong> {{ $call->internal_expedient->expedient }}
              </p>

              <p class="text-left"><strong>@lang('call.status'):</strong> {{ $call->status }}</p>

              <p class="text-left"><strong>@lang('call.operation'):</strong> {{ $call->type_of_operation }}</p>

              <p class="text-left"><strong>@lang('call.observations'):</strong> {{ $call->observations }}</p>

              <p class="text-left"><strong>@lang('call.attended'):</strong> {{ $call->user->name }}</p>

              <p class="text-left">
                <strong>@lang('call.priority'):</strong> <span class="label
                  @if ($call->priority == 'Baja')
                    label-primary
                  @elseif ($call->priority == 'Media')
                    label-warning
                  @else
                    label-danger
                  @endif">{{ $call->priority }}</span>
              </p>

              <p class="text-left"><strong>@lang('call.hour'):</strong> {{ (isset($call->updated)) ? $call->updated : $call->created }}</p>

              <p class="text-left"><strong>@lang('call.actions')</strong></p>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('calls.partials.buttons.edit-complete')

                @include('calls.partials.buttons.delete-complete')
              </div>
            </div>
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="form-group clearfix">
              <div
                class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center block clearfix">
                @include('calls.partials.buttons.create')
              </div>
            </div>

            @include('calls.partials.buttons.back')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
