@extends('layouts.app')

@section('title', "Editar | ".__('section.clients'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading([
          'route' => route('dashboard'),
          'routeTitle' => __('section.clients'),
          'title' => __('section.clients'),
        ])
          <div class="hidden-xs col-sm-3 col-md-3 col-lg-2 pull-right text-right">
            @clientsButtonCreate
            @endclientsButtonCreate
          </div>
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  @include('clients.partials.table-header')
                </tr>
              </thead>

              <tfoot>
                <tr>
                  @include('clients.partials.table-footer')
                </tr>
              </tfoot>

              <tbody>
                @include('clients.partials.item')
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="form-group clearfix">
              <div
                class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center block clearfix">
                @clientsButtonCreate
                @endclientsButtonCreate
              </div>
            </div>

            @clientsButtonBack
            @endclientsButtonBack
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
