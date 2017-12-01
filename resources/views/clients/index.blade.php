@extends('layouts.app')

@section('title', "Lista | ".__('section.clients'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('dashboard') }}" title="@lang('section.clients')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.clients')
            <div class="hidden-xs col-sm-3 col-md-3 col-lg-2 pull-right text-right">
              @include('clients.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          @if (count($clients) < 1)
            <h2 class="text-center">No hay clientes registrados. ¿Porqué no das de alta un nuevo cliente??</h2>
            <div class="hidden-xs hidden-sm col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5 text-center">
              @include('clients.partials.buttons.create')
            </div>
          @else
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
              {{ $clients->links() }}

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
                  @each('clients.partials.items', $clients, 'client')
                </tbody>
              </table>

              {{ $clients->links() }}
            </div>
          @endif
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center">
              @include('clients.partials.buttons.create')
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
