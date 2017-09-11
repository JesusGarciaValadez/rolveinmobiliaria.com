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
          <h1 class="col-xs-12 col-sm-8 col-md-7 col-lg-6">Nueva llamada</h1>
        </div>

        <div class="panel-body table-responsive">
          @if (session('message'))
            <div class="alert alert-{{ session('type') }}">
              {{ session('message') }}
            </div>
          @endif
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
