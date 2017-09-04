@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
          <div class="list-group">
            <a href="{{ route('call_trackings') }}" class="list-group-item" title="@lang('section.call_tracking')">@lang('section.call_tracking')</a>
            <a href="#" class="list-group-item" title="@lang('section.for_sale')">@lang('section.for_sale')</a>
            <!--
            <a href="#" class="list-group-item" title="@lang('section.rent')">@lang('section.rent')</a>
            <a href="#" class="list-group-item" title="@lang('section.mortgage_cancellation')">@lang('section.mortgage_cancellation')</a>
            <a href="#" class="list-group-item" title="@lang('section.legal')">@lang('section.legal')</a>
            <a href="#" class="list-group-item" title="@lang('section.succession')">@lang('section.succession')</a>
            -->
          </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('section.notifications')</div>

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
