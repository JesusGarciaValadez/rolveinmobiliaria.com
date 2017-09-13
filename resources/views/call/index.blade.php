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
            <a href="{{ route('call_trackings') }}" title="Seguimiento de llamadas" class="pull-left hidden-xs">
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
                @each('call.partials.items', $calls, 'call')
              </tbody>
            </table>
          </div>

          <div class="row">
            {{ $calls->links() }}
          </div>

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
@endsection
