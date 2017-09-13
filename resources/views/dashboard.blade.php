@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
          @include('shared.partials.menu')
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