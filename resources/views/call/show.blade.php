@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="hidden-xs hidden-sm col-md-3 col-lg-2">
      @include('shared.partials.menu')
    </div>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('call_trackings') }}" title="Seguimiento de llamadas" class="pull-left hidden-xs hidden-sm">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.call_tracking')
            <div class="hidden-xs hidden-sm col-md-2 col-lg-2 pull-right text-right">
              <a href="{{ route('create_call') }}" title="@lang('call.new_call')" class="btn btn-primary" role="button">@lang('call.new_call')</a>
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @if (session('message'))
            <div class="alert alert-{{ session('type') }}">
              {{ session('message') }}
            </div>
          @endif

          <div class="row">
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
                <tr>
                  <td>{{ $call->id }}</td>
                  <td>{{ $call->type_of_operation }}</td>
                  <td>{{ $call->client_phone_1 }}</td>
                  <td>{{ $call->client_phone_2 }}</td>
                  <td>{{ $call->email }}</td>
                  <td>{{ $call->user->name }}</td>
                  <td class="hidden-xs hidden-sm">{{ $call->observations }}</td>
                  <td>{{ $call->address }}</td>
                  <td>{{ $call->state->name }}</td>
                  <td>{{ $call->hour }}</td>
                  <td>
                    <div class="form-group">
                      <a class="btn btn-primary" href="{{ route('edit_call', ['id' => $call->id]) }}" title="Editar" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>
                    </div>

                    <form class="form-inline" action="{{ route('destroy_call', ['id' => $call->id]) }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <div class="form-group">
                        <button type="submit" class="btn btn-danger">
                          <i class="glyphicon glyphicon-trash"></i> Eliminar
                        </button>
                      </div>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="row">
            <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 hidden-md hidden-lg">
              <a href="{{ route('create_call') }}" title="@lang('call.new_call')" class="btn btn-primary form-control" role="button">@lang('call.new_call')</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
