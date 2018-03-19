@extends('layouts.app')

@section('title', "Expediente ".$message->expedient."| ".__('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading( [
          'route' => url()->previous(),
          'routeTitle' => __('message.message'),
          'title' => __('message.new_message'),
        ])
          <div class="hidden-xs col-sm-3 col-md-2 col-lg-2 pull-right text-right">
            @messagesButtonCreate
            @endmessagesButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h2>@lang('message.information')</h2>
              <p class="text-left"><strong>@lang('message.name'):</strong> {{ $message->name }}</p>

              <p class="text-left"><strong>@lang('message.email'):</strong> {{ $message->email }}</p>

              <p class="text-left"><strong>@lang('message.observations'):</strong> {{ $message->observations }}</p>

              <p class="text-left"><strong>@lang('message.attended'):</strong> {{ $message->user->name }}</p>

              <p class="text-left"><strong>@lang('message.hour'):</strong> {{ (isset($message->updated)) ? $message->updated : $message->created }}</p>

              <p class="text-left"><strong>@lang('message.actions')</strong></p>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @can('messages.update')
                  @messagesButtonEditComplete(['message' => $message])
                  @endmessagesButtonEditComplete
                @endcan

                @can('messages.delete')
                  @messagesButtonDeleteComplete(['message' => $message])
                  @endmessagesButtonDeleteComplete
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
                @messagesButtonCreate
                @endmessagesButtonCreate
              </div>
            </div>

            @messagesButtonBack(['back' => route('messages')])
            @endmessagesButtonBack
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
