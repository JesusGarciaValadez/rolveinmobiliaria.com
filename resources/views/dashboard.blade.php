@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <div class="row">
      @lateralMenu
      @endlateralMenu

      <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title">@lang('section.notifications')</h1>
          </div>

          <div class="panel-body">
            @alert(['type' => session('type'), 'message' => session('message')])
            @endalert

            @lang('auth.you_are_logged_in')
          </div>

          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
