@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-11 col-xs-offset-0 col-sm-4 col-md-3 col-lg-3 list-group">
          <a href="#" class="list-group-item">Seguimiento de llamadas</a>
          <a href="#" class="list-group-item">Compra venta</a>
          <a href="#" class="list-group-item">Renta</a>
          <a href="#" class="list-group-item">Cancelación de hipoteca</a>
          <a href="#" class="list-group-item">Jurídico</a>
          <a href="#" class="list-group-item">Sucesión</a>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-1 col-lg-8 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  @if (session('status'))
                    <div class="alert alert-success">
                      {{ session('status') }}
                    </div>
                  @endif

                  @lang('auth.you_are_logged_in')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
