@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('shared.partials.menu')
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h1 class="panel-title">@lang('section.notifications')</h1>
                </div>

                <div class="panel-body">
                  @if (session('status'))
                    <div class="alert alert-success">
                      {{ session('status') }}
                    </div>
                  @endif

                  @lang('auth.you_are_logged_in')
                </div>

                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
