@extends('layouts.app')

@section('title', "Editar | ".__('section.clients'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <a href="{{ route('dashboard') }}" title="@lang('section.clients')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.clients')
          </h1>
          <h1 class="hidden-xs hidden-sm col-md-3 col-lg-2">
            <div class="pull-right text-right text-center">
              @include('clients.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

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
                @include('clients.partials.buttons.create')
              </div>
            </div>

            @include('clients.partials.buttons.back')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
