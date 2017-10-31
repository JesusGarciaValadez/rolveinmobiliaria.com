@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('shared.partials.menu')

        <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h1 class="panel-title">@lang('shared.error')</h1>
                </div>

                <div class="panel-body">
                  <div class="flex-center position-ref full-height">
                      <div class="content">
                          <div class="title">
                              <h2>{{ $exception->getMessage() }}</h2>
                              <img src="img/you-shall-not-pass.gif" alt="No lograrás pasar" style="display: block; margin: 0 auto;">
                          </div>
                      </div>
                  </div>
                </div>

                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
