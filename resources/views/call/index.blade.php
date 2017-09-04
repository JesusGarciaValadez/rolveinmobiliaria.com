@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
      <div class="list-group">
        <a href="{{ route('call_trackings') }}" class="list-group-item" title="@lang('section.call_tracking')">@lang('section.call_tracking')</a>
        <a href="#" class="list-group-item" title="@lang('section.for_sale')">@lang('section.for_sale')</a>
      </div>
    </div>
    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
      <div class="panel panel-default">
        <div class="panel-heading">@lang('auth.register')</div>

        <div class="panel-body">
          <table class="table-responsive table-striped table-condensed">
            <thead>
              <th>ID</th>
              <th>Tipo de operación</th>
              <th>Teléfono de cliente 1</th>
              <th>Teléfono de cliente 2</th>
              <th>Email del cliente</th>
              <th>Usuario</th>
              <th>Observaciones</th>
              <th>Dirección del inmueble</th>
              <th>Estado de la república</th>
              <th>Hora de la llamada</th>
            </thead>

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
            </tfoot>

            <tbody>
              <tr>{{ $call->id }}</tr>
              <tr>{{ $call->type_of_operation }}</tr>
              <tr>{{ $call->client_phone_1 }}</tr>
              <tr>{{ $call->client_phone_2 }}</tr>
              <tr>{{ $call->email }}</tr>
              <tr>{{ $call->user }}</tr>
              <tr>{{ $call->observations }}</tr>
              <tr>{{ $call->address }}</tr>
              <tr>{{ $call->state }}</tr>
              <tr>{{ $call->created_at }}</tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
