@extends('layouts.app')

@section('title', "Editar | ".__('section.for_sale'))

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
            @lang('section.for_sale')
            <div class="hidden-xs col-sm-3 col-md-3 col-lg-2 pull-right text-right">
              @include('sales.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

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
