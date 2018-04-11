@extends('layouts.app')

@section('title', "Editar | ".__('section.for_sale'))

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
        ])
          @slot('title')
            @lang('shared.edit') @lang('sale.sale')
          @endslot
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          <form
            id="purchase-sale"
            class="form-vertical"
            action="{{ route('update_sale', [
              'id' => request('id')
            ]) }}"
            method="post"
            enctype="multipart/form-data"
            autocapitalize="sentences" v-cloak>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              @csrf
              @method('PUT')

              @include('sales.partials.forms.edit.seller')
              @include('sales.partials.forms.edit.closing-contract')
              @include('sales.partials.forms.edit.log-of-visits-and-calls')
              @include('sales.partials.forms.edit.contract')
              @include('sales.partials.forms.edit.notary')
              @include('sales.partials.forms.edit.signature')

              <div class="alert alert-success" role="alert" v-if="saleIsComplete">
                <p><strong>¡Excelente!</strong> Este expediente tiene toda la documentación necesaria.</p>
              </div>
              <div class="alert alert-danger" role="alert" v-else="!saleIsComplete">
                <p><strong>¡Cuidado!</strong> Este expediente aún no tiene toda la documentación necesaria.</p>
              </div>
            </div>

            <div class="panel-footer">
              <div class="form-inline">
                @salesButtonSave
                @endsalesButtonSave

                @salesButtonBack
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
