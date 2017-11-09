@extends('layouts.app')

@section('title', "Acción denegada")

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
                              <h2>{{ empty($exception->getMessage())
                                ? 'Esta acción no está autorizada.'
                                : $exception->getMessage() }}</h2>
                              <img
                                src="{{ asset('img/you-shall-not-pass.gif') }}"
                                style="display: block; margin: 0 auto;"
                                alt="No lograrás pasar">
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
