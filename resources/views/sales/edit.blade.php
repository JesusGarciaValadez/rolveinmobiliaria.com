@extends('layouts.app')

@section('title', "Editar | ".('section.for_sale'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('dashboard') }}" title="@lang('section.sales')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('shared.edit') @lang('sale.sale')
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @include('sales.partials.forms.edit.documents')
            @include('sales.partials.forms.edit.closing-contract')
            @include('sales.partials.forms.edit.log-of-visits-and-calls')
            @include('sales.partials.forms.edit.purchase-agreement')
            @include('sales.partials.forms.edit.notary')
            @include('sales.partials.forms.edit.endorsement')
          </div>

          <div class="block">
            @include('sales.partials.buttons.back', [
              'back' => route('for_sales')
            ])
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
