@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ url()->previous() }}" title="@lang('section.call_tracking')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.call_tracking')
            <div class="hidden-xs col-sm-2 col-md-2 col-lg-2 pull-right text-right">
              @include('call.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <div class="row">
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <th class="text-center">@lang('call.id')</th>
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
                <th class="text-center">@lang('call.actions')</th>
              </thead>

              <tfoot>
                <tr>
                  <td colspan="15"></td>
                </tr>
              </tfoot>

              <tbody>
                <tr>
                  <td>{{ $call->id }}</td>
                  <td>{{ $call->expedient }}</td>
                  <td>{{ $call->type_of_operation }}</td>
                  <td>{{ $call->client }}</td>
                  <td>{{ $call->client_phone_1 }}</td>
                  <td>{{ $call->client_phone_2 }}</td>
                  <td>
                    <a href="mailto:{{ $call->email }}" title="@lang('shared.send_email_to') {{ $call->client }}" target="_blank">{{ $call->email }}</a>
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
                  <td class="text-center">
                    @include('call.partials.buttons.edit')

                    @include('call.partials.buttons.delete')
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-6 col-xs-offset-4 col-sm-6 col-sm-offset-5 hidden-md hidden-lg">
              @include('call.partials.buttons.create')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
