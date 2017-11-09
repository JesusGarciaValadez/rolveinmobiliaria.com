@extends('layouts.app')

@section('title', "Lista | " . __('section.call_tracking'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('dashboard') }}" title="Seguimiento de llamadas" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.call_tracking')
            <div class="hidden-xs col-sm-2 col-md-2 col-lg-2 pull-right text-right">
              @include('calls.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          @if (count($calls) < 1)
            <h2 class="text-center">No hay llamadas registradas. ¿Porqué no creas una nueva?</h2>
            <div class="hidden-xs hidden-sm col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5 text-center">
              @include('calls.partials.buttons.create')
            </div>
          @else
            @include('calls.partials.search')

            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
              {{ $calls->links() }}

              <table class="table table-bordered table-striped table-condensed">
                <thead>
                  <tr>
                    @include('calls.partials.table-header')
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    @include('calls.partials.table-footer')
                  </tr>
                </tfoot>

                <tbody>
                  @each('calls.partials.items', $calls, 'call')
                </tbody>

              </table>

              {{ $calls->links() }}
            </div>

          @endif
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-6 col-xs-offset-5 col-sm-6 col-sm-offset-5 hidden-md hidden-lg">
              @include('calls.partials.buttons.create')
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
