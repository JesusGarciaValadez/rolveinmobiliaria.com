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
            id="edit__closing-contract"
            class="form-vertical"
            action="{{ route('for_sale.closing_contract.update', [
              'id' => request('id')
            ]) }}"
            method="post"
            enctype="multipart/form-data"
            autocapitalize="sentences" v-cloak>
            @csrf
            @method('PUT')

            @include('sales.partials.forms.edit.closing-contract')

            <div class="panel-footer">
              <div class="form-inline">
                @salesButtonSave
                @endsalesButtonSave

                @salesButtonBack(['back' => route('for_sale.index')])
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
