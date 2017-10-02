@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ url()->previous() }}" title="Seguimiento de llamadas" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('section.call_tracking')
            <div class="hidden-xs col-sm-2 col-md-2 col-lg-2 pull-right text-right">
              @include('call.partials.buttons.create')
            </div>
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <div class="row">
            <table class="table table-bordered table-striped table-condensed">
              @include('call.partials.table-heading')

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
                  <td>{{ $call->updated }}</td>
                  <td>{{ $call->status }}</td>
                  <td class="text-center">
                    @include('call.partials.buttons.edit')

                    @include('call.partials.buttons.delete')
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-5 col-xs-offset-4 col-sm-6 col-sm-offset-3 hidden-md hidden-lg">
              @include('call.partials.buttons.create')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
