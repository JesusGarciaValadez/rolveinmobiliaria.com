@extends('layouts.app')

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
            @lang('section.for_sales')
            <div class="hidden-xs col-sm-2 col-md-2 col-lg-2 pull-right text-right">
              @include('sales.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          @include('sales.partials.search')

          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {{ $calls->links() }}

            <table class="table table-bordered table-striped table-condensed">
              @include('sales.partials.table-heading')

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
                <tr></tr>
              </tfoot>

              <tbody>
                @each('sales.partials.items', $calls, 'call')
              </tbody>
            </table>

            {{ $calls->links() }}
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-6 col-xs-offset-4 col-sm-6 col-sm-offset-5 hidden-md hidden-lg">
              @include('sales.partials.buttons.create')
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
