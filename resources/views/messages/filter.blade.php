@extends('layouts.app')

@section('title', "Búsqueda | ".__('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading( [
          'route' => route('messages'),
          'routeTitle' => __('message.messages'),
          'title' => __('message.messages'),
        ])
          <div class="hidden-xs col-sm-3 col-md-3 col-lg-2 pull-right text-right">
            @messagesButtonCreate
            @endmessagesButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          @messagesFilter
          @endmessagesFilter

          @if (count($messages) < 1)
            @blankSlate([
              'message' => __('message.no_results')
            ])
              @messagesButtonCreate
              @endmessagesButtonCreate
            @endblankSlate
          @else
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
              {{ $messages->links() }}

              <table class="table table-bordered table-striped table-condensed">
                @include('messages.partials.table-header')

                <tfoot>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                </tfoot>

                <tbody>
                  @each('messages.partials.items', $messages, 'message')
                </tbody>
              </table>

              {{ $messages->links() }}
            </div>
          @endif
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="form-group col-xs-12 hidden-sm col-sm-offset-0 hidden-md hidden-lg text-center">
              @messagesButtonCreate
              @endmessagesButtonCreate
            </div>

            @messagesButtonBack(['back' => route('messages')])
            @endmessagesButtonBack
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
