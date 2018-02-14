@extends('layouts.app')

@section('title', "Editar | ".__('section.for_sale'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading( [
          'route' => route('dashboard'),
          'routeTitle' => __(route('dashboard')),
          'title' => __('section.for_sale'),
        ])
          <div class="hidden-xs col-sm-3 col-md-2 col-lg-2 pull-right text-right">
            @salesButtonCreate
            @endsalesButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  @include('sales.partials.table-header')
                </tr>
              </thead>

              <tfoot>
                <tr>
                  @include('sales.partials.table-footer')
                </tr>
              </tfoot>

              <tbody>
                @include('sales.partials.item')
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
