@extends('layouts.app')

@section('title', "Expediente ".$call->expedient."| ".__('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading([
          'route' => url()->previous(),
          'routeTitle' => __('section.call_tracking'),
          'title' => __('section.call_tracking'),
        ])
          <div class="hidden-xs col-sm-3 col-md-2 col-lg-2 pull-right text-right">
            @callsButtonCreate
            @endcallsButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

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
                @can('calls.update')
                @callsButtonEditComplete(['call' => $call])
                @endcallsButtonEditComplete
                @endcan

                @can('calls.delete')
                @callsButtonDeleteComplete(['call' => $call])
                @endcallsButtonDeleteComplete
                @endcan
              </div>
            </div>
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="form-group clearfix">
              <div
                class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center block clearfix">
                @callsButtonCreate
                @endcallsButtonCreate
              </div>
            </div>

            @callsButtonBack
            @endcallsButtonBack
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
