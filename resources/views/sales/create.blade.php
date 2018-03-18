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
          'routeTitle' => __('section.sales'),
          'title' => __('sale.new_sale'),
        ])
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          <form
            id="purchase-sale"
            class="form-vertical"
            action="{{ route('store_sale') }}"
            method="post"
            enctype="multipart/form-data"
            autocapitalize="sentences" v-cloak>
            {{ csrf_field() }}

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              @include('sales.partials.forms.create.documents')
              @include('sales.partials.forms.create.closing-contract')
              @include('sales.partials.forms.create.log-of-visits-and-calls')
              @include('sales.partials.forms.create.contract')
              @include('sales.partials.forms.create.notary')
              @include('sales.partials.forms.create.signature')
              <h2 v-if="saleIsComplete">Este expediente tiene toda la documentación necesaria.</h2>
              <h2 v-else="!saleIsComplete">Este expediente aún no tiene toda la documentación necesaria.</h2>
            </div>

            <div class="panel-footer">
              <div class="form-inline">
                @salesButtonSave
                @endsalesButtonSave

                @salesButtonBack(['back' => route('for_sales')])
                @endsalesButtonBack
              </div>
            </div>
          </form>

          @modalExpedient(['clients' => $clients])
          @endmodalExpedient

          @modalClient
          @endmodalClient
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
