@extends('layouts.app')

@section('title', "Editar | ".__('section.for_sale'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('shared.partials.menu')

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('dashboard') }}" title="@lang('section.sales')" class="pull-left visible-sm-block">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            @lang('shared.edit') @lang('sale.sale')
          </h1>
        </div>

        <div class="panel-body table-responsive">
          @include('shared.partials.alerts.message')

          <form
            id="purchase-sale"
            class="form-vertical"
            action="{{ route('store_sale') }}"
            method="post"
            enctype="multipart/form-data"
            autocapitalize="sentences" v-cloak>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              {{ csrf_field() }}

              @include('sales.partials.forms.create.documents')
              @include('sales.partials.forms.create.closing-contract')
              @include('sales.partials.forms.create.log-of-visits-and-calls')
              @include('sales.partials.forms.create.contract')
              @include('sales.partials.forms.create.notary')
              @include('sales.partials.forms.create.signature')
              <h2 v-if="saleIsComplete">Este expediente tiene toda la documentación necesaria.</h2>
              <h2 v-else="!saleIsComplete">Este expediente aún no tiene toda la documentación necesaria.</h2>
            </div>

            <div class="panel-footer">
              <div class="form-inline">
                @include('sales.partials.buttons.save')

                @include('sales.partials.buttons.back', [
                  'back' => route('for_sales')
                ])
              </div>
            </div>
          </form>
        </div>

        <div
          class="modal fade bs-example-modal-sm"
          tabindex="-1"
          role="dialog"
          aria-labelledby="makeANewLogAndVisit"
          id="newLogAndVisit">
          <div class="modal-dialog modal-sm" role="document">
            <form
              class="form-horizontal modal-content"
              action="{{ route('store_client') }}"
              method="post">
              {{ csrf_field() }}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar cliente nuevo</h4>
              </div>
              <div class="modal-body">
                <div class="form-group{{ $errors->has('SL_subject') ? ' has-error' : ''}} clearfix">
                  <label
                    for="SL_subject"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('shared.subject')</label>

                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                    <input
                      name="SL_subject"
                      type="text"
                      class="form-control"
                      value="{{ old('SL_subject') }}"
                      placeholder="@lang('shared.subject')"
                      autocorrect="on"
                      required>

                    @if ($errors->has('SL_subject'))
                      <span class="help-block">
                        <strong>{{ $errors->first('SL_subject') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('SL_email') ? ' has-error' : ''}} clearfix">
                  <label
                    for="SL_email"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('shared.email')</label>

                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                    <input
                      name="SL_email"
                      type="text"
                      class="form-control"
                      value="{{ old('SL_email') }}"
                      placeholder="@lang('shared.email')"
                      autocorrect="on">

                    @if ($errors->has('SL_email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('SL_email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('SL_phone') ? ' has-error' : ''}} clearfix">
                  <label
                    for="SL_phone"
                    class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">@lang('shared.phone')</label>

                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                    <input
                      name="SL_phone"
                      type="text"
                      class="form-control"
                      value="{{ old('SL_phone') }}"
                      placeholder="@lang('shared.phone')"
                      autocorrect="on"
                      required>

                    @if ($errors->has('SL_phone'))
                      <span class="help-block">
                        <strong>{{ $errors->first('SL_phone') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('SL_observations') ? ' has-error' : ''}} clearfix">
                  <label
                    for="SL_observations"
                    class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">@lang('shared.observations')</label>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <textarea
                      class="form-control"
                      name="SL_observations"
                      id="SL_observations"
                      placeholder="@lang('shared.observations')"
                      required
                      autocorrect="on">{{ old('SL_observations') }}</textarea>

                    @if ($errors->has('SL_observations'))
                      <span class="help-block">
                        <strong>{{ $errors->first('SL_observations') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              </div>
            </form><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      </div>
    </div>
  </div>
</div>
@endsection
