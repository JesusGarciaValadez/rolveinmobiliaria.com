@extends('layouts.app')

@section('title', "Nueva | ".__('section.sale'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading( [
          'route' => route('dashboard'),
          'routeTitle' => __('section.sales'),
          'title' => __('sale.new_sale'),
        ])
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert([
            'type' => session('type'),
            'message' => session('message')
          ])
          @endalert

          <form
            class="form-vertical"
            action="{{ route('sale.store') }}"
            method="post">
            @csrf

            @include('sales.partials.forms.create.seller')

            <div class="panel-footer">
              <div class="form-inline">
                @salesButtonSave
                @endsalesButtonSave

                @salesButtonBack([
                  'back' => route('sale.index')
                ])
                @endsalesButtonBack
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('modals')
  @modalExpedient(['clients' => $clients])
  @endmodalExpedient

  @modalClient
  @endmodalClient
@endsection
