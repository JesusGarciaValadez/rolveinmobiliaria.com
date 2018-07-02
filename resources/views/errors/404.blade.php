@extends('layouts.app')

@section('title', "Página no encontrada")

@section('content')
<div class="container-fluid">
    <div class="row">
        @lateralMenu()
        @endlateralMenu

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
                                ? 'Página no encontrada.'
                                : $exception->getMessage() }}</h2>
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
