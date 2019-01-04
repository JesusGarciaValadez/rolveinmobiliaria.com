@extends('layouts.app')

@section('title', "Editar | ".__('sale.sellers'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading( [
          'route' => route('dashboard')
        ])
          @slot('routeTitle')
            @lang('shared.edit') @lang('sale.sellers')
          @endslot

          @slot('title')
            @lang('shared.edit') @lang('sale.sellers')
          @endslot
        @endpanelHeading

        <div class="panel-body table-responsive">
          @alert([
            'type' => session('type'),
            'message' => session('message')
          ])
          @endalert

          <form
            class="form-vertical"
            action="{{ route('sale.seller.update', [
              'sale' => $sale->id,
              'seller' => $sale->seller->id
            ]) }}"
            method="post">
            @method('PUT')
            @csrf

            @include('sales.partials.forms.edit.seller')

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
