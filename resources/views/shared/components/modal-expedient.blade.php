<div
  class="modal fade bs-example-modal-lg"
  tabindex="-1"
  role="dialog"
  aria-labelledby="makeANewExpedient"
  id="new__expedient">
  <div class="modal-dialog modal-lg" role="document">
    <form
      class="form-horizontal modal-content"
      id="expedient-info"
      action="{{ route('store_internal_expedient') }}"
      method="post">
      @csrf

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang('call.new_expedient')</h4>
      </div>
      <div class="modal-body">
        <div class="form-group{{ $errors->has('expedient_key') ? ' has-error' : '' }}">
          <label
            for="client_id"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.internal_expedient_key'):
          </label>
          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">
            <select
              class="form-control"
              name="expedient_key"
              value="{{ old('expedient_key') }}">
              <option value="" checked disabled>@lang('shared.choose_an_option')</option>
              <option value="VNT">VNT</option>
              <option value="RNT">RNT</option>
              <option value="CEX">CEX</option>
              <option value="JRD">JRD</option>
              <option value="AVA">AVA</option>
            </select>

            @if ($errors->has('expedient_key'))
              <span class="help-block">
                <strong>{{ $errors->first('expedient_key') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('expedient_number') ? ' has-error' : '' }}">
          <label
            for="client_id"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.internal_expedient_number'): </label>
          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">
            <input
              type="text"
              class="form-control"
              name="expedient_number"
              value="{{ old('expedient_number') }}"
              placeholder="@lang('call.internal_expedient_number')"
              autocorrect="on"
              size="2">

              @if ($errors->has('expedient_number'))
                <span class="help-block">
                  <strong>{{ $errors->first('expedient_number') }}</strong>
                </span>
              @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('expedient_year') ? ' has-error' : '' }}">
          <label
            for="client_id"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.internal_expedient_year'): </label>
          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">
            <input
              type="number"
              min="00"
              max="99"
              class="form-control"
              name="expedient_year"
              value="{{ old('expedient_year') }}"
              placeholder="@lang('call.internal_expedient_year')"
              autocorrect="on">

              @if ($errors->has('expedient_year'))
                <span class="help-block">
                  <strong>{{ $errors->first('expedient_year') }}</strong>
                </span>
              @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
          <label
            for="client_id"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.client'): </label>
          <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
            <select
              class="form-control"
              id="client_id"
              name="client_id"
              autofocus
              v-model="client.id"
              @change="getClientInfo">
              <option
                value=""
                selected
                disabled>
                @lang('shared.choose_an_option')</option>
              @foreach ($clients as $client)
                <option
                  value="{{ $client->id }}"
                  @if (old('client_id') == $client->id )
                    selected
                  @endif>{{ $client->full_name }}</option>
              @endforeach
            </select>

            @if ($errors->has('client_id'))
              <span class="help-block">
                <strong>{{ $errors->first('client_id') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <div class="clearfix block col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-3 col-lg-8 col-lg-offset-2 alert alert-info" v-if="!loading && !empty">
            <client
              :name="fullName"
              :phone-one="client.phoneOne"
              :phone-two="client.phoneTwo"
              :business="client.business"
              :email-one="client.emailOne"
              :email-two="client.emailTwo"
              :reference="client.reference"
              :has-client="hasClient"></client>
          </div>
          <spinner v-if="loading"></spinner>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
