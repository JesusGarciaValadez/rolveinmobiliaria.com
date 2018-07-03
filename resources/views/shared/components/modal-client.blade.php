<div
  class="modal fade bs-example-modal-lg"
  tabindex="-1"
  role="dialog"
  aria-labelledby="makeANewClient"
  id="newClient">
  <div class="modal-dialog modal-lg" role="document">
    <form
      class="form-horizontal modal-content"
      action="{{ route('client.store') }}"
      method="post">
      @csrf

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang('call.new_client')</h4>
      </div>
      <div class="modal-body">
        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
          <label
            for="first_name"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.clients_first_name'):
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="text"
              class="form-control"
              name="first_name"
              id="first_name"
              value="{{ old('first_name') }}"
              placeholder="@lang('call.clients_first_name')"
              autocomplete="given-name"
              autocorrect="on"
              required>

            @if ($errors->has('first_name'))
              <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : ''}}">
          <label
            for="last_name"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.clients_last_name'):
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="text"
              class="form-control"
              name="last_name"
              id="last_name"
              value="{{ old('last_name') }}"
              placeholder="@lang('call.clients_last_name')"
              autocomplete="family-name"
              autocorrect="on"
              required>

            @if ($errors->has('last_name'))
              <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('phone_1') ? ' has-error' : ''}}">
          <label
            for="phone_1"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.phone') 1:
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="tel"
              class="form-control"
              name="phone_1"
              id="phone_1"
              value="{{ old('phone_1') }}"
              placeholder="@lang('call.phone') 1"
              autocomplete="tel-national"
              autocorrect="on"
              required>

            @if ($errors->has('phone_1'))
              <span class="help-block">
                <strong>{{ $errors->first('phone_1') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('phone_2') ? ' has-error' : ''}}">
          <label
            for="phone_2"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.phone') 2:
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="tel"
              class="form-control"
              name="phone_2"
              id="phone_2"
              value="{{ old('phone_2') }}"
              placeholder="@lang('call.phone') 2"
              autocorrect="on"
              autocomplete="tel-local">

            @if ($errors->has('phone_2'))
              <span class="help-block">
                <strong>{{ $errors->first('phone_2') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('business') ? ' has-error' : ''}}">
          <label
            for="business"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.clients_business'):
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="text"
              class="form-control"
              name="business"
              id="business"
              value="{{ old('business') }}"
              placeholder="@lang('call.clients_business')"
              autocorrect="on"
              autocomplete="organization">

            @if ($errors->has('business'))
              <span class="help-block">
                <strong>{{ $errors->first('business') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email_1') ? ' has-error' : ''}}">
          <label
            for="email"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.email'):
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="email"
              class="form-control"
              name="email_1"
              value="{{ old('email_1') }}"
              placeholder="@lang('call.email')"
              autocomplete="email"
              autocorrect="on">

            @if ($errors->has('email_1'))
              <span class="help-block">
                <strong>{{ $errors->first('email_1') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email_2') ? ' has-error' : ''}}">
          <label
            for="email"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.email'):
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="email"
              class="form-control"
              name="email_2"
              value="{{ old('email_2') }}"
              placeholder="@lang('call.email')"
              autocomplete="email"
              autocorrect="on">

            @if ($errors->has('email_2'))
              <span class="help-block">
                <strong>{{ $errors->first('email_2') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('reference') ? ' has-error' : ''}}">
          <label
            for="reference"
            class="col-xs-12 col-sm-4 col-md-4 col-lg-3 control-label">
            @lang('call.clients_reference'):
          </label>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
            <input
              type="text"
              class="form-control"
              name="reference"
              id="reference"
              value="{{ old('reference') }}"
              placeholder="@lang('call.clients_reference')"
              autocorrect="on">

            @if ($errors->has('reference'))
              <span class="help-block">
                <strong>{{ $errors->first('reference') }}</strong>
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
