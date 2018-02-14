@extends('layouts.app')

@section('title', "Búsqueda | ".__('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading( [
          'route' => route('dashboard'),
          'routeTitle' => __('section.call_tracking'),
          'title' => __('section.call_tracking'),
        ])
          <div class="hidden-xs col-sm-2 col-md-2 col-lg-2 pull-right text-right">
            @callsButtonCreate
            @endcallsButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          @callsFilter
          @endcallsFilter

          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {{ $calls->links() }}

            <table class="table table-bordered table-striped table-condensed">
              @include('calls.partials.table-header')

              <tfoot>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
              </tfoot>

              <tbody>
                @each('calls.partials.items', $calls, 'call')
              </tbody>
            </table>

            {{ $calls->links() }}
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-5 col-xs-offset-4 hidden-sm col-sm-offset-0 hidden-md hidden-lg">
              @callsButtonCreate
              @endcallButtonCreate
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
