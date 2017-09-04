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
          <table class="table-responsive table-bordered table-striped table-condensed">
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
              @foreach( $calls as $call )
              <tr>
                <td>{{ $call->id }}</td>
                <td>{{ $call->type_of_operation }}</td>
                <td>{{ $call->client_phone_1 }}</td>
                <td>{{ $call->client_phone_2 }}</td>
                <td>{{ $call->email }}</td>
                <td>{{ $call->user->name }}</td>
                <td>{{ $call->observations }}</td>
                <td>{{ $call->address }}</td>
                <td>{{ $call->state->name }}</td>
                <td>{{ $call->created_at }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
