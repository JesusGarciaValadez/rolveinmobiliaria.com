@extends('layouts.app')

@section('title', "Lista | " . __('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading([
          'route' => route('dashboard'),
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

          @if (count($calls) < 1)
            @blankSlate([
              'message' => __('No hay llamadas registradas. ¿Porqué no creas una nueva?')
            ])
              @callsButtonCreate
              @endcallsButtonCreate
            @endblankSlate
          @else
            @messagesFilter
            @endmessagesFilter

            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
              {{ $calls->links() }}

              <table class="table table-bordered table-striped table-condensed">
                <thead>
                  <tr>
                    @include('calls.partials.table-header')
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    @include('calls.partials.table-footer')
                  </tr>
                </tfoot>

                <tbody>
                  @each('calls.partials.items', $calls, 'call')
                </tbody>

              </table>

              {{ $calls->links() }}
            </div>

          @endif
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center">
              @callsButtonCreate
              @endcallsButtonCreate
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
