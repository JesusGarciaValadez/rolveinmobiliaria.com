@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group">
                <li class="list-group-item active"><a href="#" class="list-group-item-action">Seguimiento de llamadas</a></li>
                <li class="list-group-item"><a href="#" class="list-group-item-action">Compra venta</a></li>
                <li class="list-group-item"><a href="#">Renta</a></li>
                <li class="list-group-item"><a href="#">Cancelación de hipoteca</a></li>
                <li class="list-group-item"><a href="#">Jurídico</a></li>
                <li class="list-group-item"><a href="#">Sucesión</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-md-offset-1">
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
