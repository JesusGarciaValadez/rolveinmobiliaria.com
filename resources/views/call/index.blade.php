@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('dashboard') }}" title="Seguimiento de llamadas" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.call_tracking')
            <div class="hidden-xs col-sm-2 col-md-2 col-lg-2 pull-right text-right">
              <a href="{{ route('create_call') }}" title="@lang('call.new_call')" class="btn btn-primary" role="button">@lang('call.new_call')</a>
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @if (session('message'))
          <div class="alert alert-{{ session('type') }}">{{ session('message') }}</div>
          @endif

          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-inline clearfix" role="search" action="{{ route('search_call') }}" method="get">
              {{ csrf_field() }}
              <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6{{ $errors->has('date') ? ' has-error' : ''}}">
                <label for="date" class="form-label">Filtrar por: </label>

                <select name="date" id="date" class="form-control input-sm" required autofocus>
                  <option value="{{ now()->today() }}" {{ session('date') == now()->today() ? 'selected' : '' }}>Hoy</option>
                  <option value="{{ now()->today()->addDays(5) }}" {{ session('date') == now()->today()->addDays(5) ? 'selected' : '' }}>Últimos 5 días</option>
                  <option value="{{ now()->today()->addWeeks(2) }}" {{ session('date') == now()->today()->addWeeks(2) ? 'selected' : '' }}>Últimos 2 semanas</option>
                  <option value="{{ now()->today()->addMonth() }}" {{ session('date') == now()->today()->addMonth() ? 'selected' : '' }}>Último mes</option>
                  <option value="{{ now()->today()->addMonths(6) }}" {{ session('date') == now()->today()->addMonths(6) ? 'selected' : '' }}>Últimos 6 meses</option>
                </select>

                <button type="submit" class="btn btn-default">Buscar</button>
              </div>

              @if ($errors->has('type_of_operation'))
                <span class="help-block">
                  <strong>{{ $errors->first('type_of_operation') }}</strong>
                </span>
              @endif
            </form>
          </div>

          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <th>@lang('call.id')</th>
                <th>@lang('call.operation')</th>
                <th>@lang('call.phone')</th>
                <th>@lang('call.phone')</th>
                <th>@lang('call.email')</th>
                <th>@lang('call.user')</th>
                <th class="hidden-xs hidden-sm">@lang('call.observations')</th>
                <th>@lang('call.direction')</th>
                <th>@lang('call.state')</th>
                <th>@lang('call.hour')</th>
                <th>@lang('call.actions')</th>
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
          </div>

          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {{ $calls->links() }}
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-6 col-xs-offset-3 hidden-sm col-sm-offset-0 hidden-md hidden-lg">
              <a href="{{ route('create_call') }}" title="@lang('call.new_call')" class="btn btn-primary form-control" role="button">@lang('call.new_call')</a>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
