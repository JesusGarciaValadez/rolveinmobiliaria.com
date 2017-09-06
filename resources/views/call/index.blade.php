@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="hidden-xs hidden-sm col-md-3 col-lg-2">
      @include('shared.partials.menu')
    </div>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>@lang('section.call_tracking')</h1>
        </div>

        <div class="panel-body table-responsive">
          @if (session('message'))
            <div class="alert alert-{{ session('type') }}">
              {{ session('message') }}
            </div>
          @endif
          <table class="table table-bordered table-striped table-condensed">
            <thead>
              <th>ID</th>
              <th>Operación</th>
              <th>Teléfono</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Usuario</th>
              <th class="hidden-xs hidden-sm">Observaciones</th>
              <th>Dirección</th>
              <th>Estado</th>
              <th>Hora</th>
              <th>Acciones</th>
            </thead>

            <tfoot>
              <tr></tr>
              <tr></tr>
              <tr></tr>
              <tr></tr>
              <tr></tr>
              <tr class="hidden-xs hidde-sm"></tr>
              <tr></tr>
              <tr></tr>
              <tr></tr>
              <tr></tr>
            </tfoot>

            <tbody>
              @each('call.partials.items', $calls, 'call')
            </tbody>
          </table>

          {{ $calls->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
