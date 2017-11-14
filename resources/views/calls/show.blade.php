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
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <th class="text-center">@lang('call.actions')</th>
                <th class="text-center">@lang('call.internal_expedient')</th>
                <th class="text-center">@lang('call.operation')</th>
                <th class="text-center">@lang('call.client')</th>
                <th class="text-center">@lang('call.phone')</th>
                <th class="text-center">@lang('call.phone')</th>
                <th class="text-center">@lang('call.email')</th>
                <th class="hidden-xs hidden-sm text-center">@lang('call.observations')</th>
                <th class="text-center">@lang('call.direction')</th>
                <th class="text-center">@lang('call.state')</th>
                <th class="text-center">@lang('call.hour')</th>
                <th class="text-center">@lang('call.status')</th>
                <th class="text-center">@lang('call.priority')</th>
              </thead>

              <tfoot>
                <tr>
                  <td colspan="13"></td>
                </tr>
              </tfoot>

              <tbody>
                <tr>
                  <td class="text-center">
                    @include('calls.partials.buttons.edit')

                    @include('calls.partials.buttons.delete')
                  </td>
                  <td>{{ $call->expedient }}</td>
                  <td>{{ $call->type_of_operation }}</td>
                  <td>{{ $call->client->full_name }}</td>
                  <td>{{ $call->client->phone_1 }}</td>
                  <td>{{ $call->client->phone_2 }}</td>
                  <td>
                    <a href="mailto:{{ $call->client->email }}" title="@lang('shared.send_email_to') {{ $call->client->name }}" target="_blank">{{ $call->client->email }}</a>
                  </td>
                  <td class="hidden-xs hidden-sm">{{ $call->observations }}</td>
                  <td>{{ $call->address }}</td>
                  <td>{{ $call->state->name }}</td>
                  <td>{{ (isset($call->updated)) ? $call->updated : $call->created }}</td>
                  <td>{{ $call->status }}</td>
                  <td><span class="label
                    @if ($call->priority == 'Baja')
                      label-primary
                    @elseif ($call->priority == 'Media')
                      label-warning
                    @else
                      label-danger
                    @endif">{{ $call->priority }}</span></td>
                </tr>
              </tbody>
            </table>
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
