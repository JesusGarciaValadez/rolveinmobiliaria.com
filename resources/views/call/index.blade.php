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
          <h1 class="col-xs-12 col-sm-8 col-md-7 col-lg-6">@lang('section.call_tracking')</h1>
          <div class="col-xs-12 col-sm-4 col-md-5 col-lg-6 text-right"><a href="{{ route('create_call') }}" title="@lang('call.new_call')" class="btn btn-success">@lang('call.new_call')</a></div>
        </div>

        <div class="panel-body table-responsive">
          @if (session('message'))
            <div class="alert alert-{{ session('type') }}">
              {{ session('message') }}
            </div>
          @endif
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

          {{ $calls->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
