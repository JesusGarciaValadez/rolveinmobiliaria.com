@extends('layouts.app')

@section('title', "Lista | ".__('section.call'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading([
          'route' => route('dashboard'),
          'routeTitle' => __('section.call'),
          'title' => __('section.call'),
        ])
          <div class="hidden-xs col-sm-3 col-md-3 col-lg-2 pull-right text-right">
            @callsButtonCreate
            @endcallsButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert([
            'type' => session('type'),
            'message' => session('message')
          ])
          @endalert

          @callsFilter
          @endcallsFilter

          @if (count($calls) < 1)
            @blankSlate([
              'message' => __('call.blank_slate')
            ])
              @callsButtonCreate
              @endcallsButtonCreate
            @endblankSlate
          @else
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
