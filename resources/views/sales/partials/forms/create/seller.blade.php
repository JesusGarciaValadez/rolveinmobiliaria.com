<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="sellers">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        @lang('sale.sellers')
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse in collapse-in" role="tabpanel" aria-labelledby="sellers">
    <div class="panel-body">
      <fieldset>
        <div class="block clearfix form-group{{ $errors->has('internal_expedient_id') ? ' has-error' : ''}}">
          <label
            for="expedient_id"
            class="col-xs-12 col-sm-12 col-md-2 col-lg-2 control-label">@lang('call.internal_expedient'): </label>
          <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <select
              class="form-control"
              id="internal_expedient_id"
              name="internal_expedient_id"
              autofocus
              @change="getExpedientInfo">
              <option
                value=""
                selected
                disabled>
                @lang('shared.choose_an_option')</option>
              @foreach ($expedients as $expedient)
                <option
                  value="{{ $expedient->id }}"
                  {{ (old('internal_expedient_id') === $expedient->id)
                      ? 'selected'
                      : ''}}>{{ $expedient->expedient }}</option>
              @endforeach
            </select>
            <input type="hidden" name="client_id" :value="client.id">
            <input type="hidden" name="expedient" :value="client.expedient">

            @if ($errors->has('internal_expedient_id'))
              <span class="help-block">
                <strong>{{ $errors->first('internal_expedient_id') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="block row clearfix col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" :has-expedient="hasExpedient">
            <strong>¿No encuentras el expediente?</strong>
            <a
              href="#"
              title="¡Crealo!"
              target="_self"
              data-toggle="modal"
              data-target="#newExpedient">¡Crealo!</a>
          </p>
        </div>

        <Spinner v-if="loading"></Spinner>
        <Expedient
          :expedient="client.expedient"
          :name="fullName"
          :phone-one="client.phoneOne"
          :phone-two="client.phoneTwo"
          :business="client.business"
          :email-one="client.emailOne"
          :email-two="client.emailTwo"
          :reference="client.reference"
          :has-client="hasClient"
          :empty="empty"
          v-else="!loading"></Expedient>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_deed') ? ' has-error' : ''}}">{{-- SD_deed --}}
          <label
            for="SD_deed"
            class="checkbox-inline control-label">
            <input
              name="SD_deed"
              id="SD_deed"
              type="checkbox"
              v-model="sale.seller.deed"
              @if (old('SD_deed'))
                checked
              @endif>@lang('sale.sellers_deed')
          </label>

          @if ($errors->has('SD_deed'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_deed') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_water') ? ' has-error' : ''}}">{{-- SD_water --}}
          <label
            for="SD_water"
            class="checkbox-inline control-label">
            <input
              name="SD_water"
              id="SD_water"
              type="checkbox"
              v-model="sale.seller.water"
              @if (old('SD_water'))
                checked
              @endif>@lang('sale.sellers_water')
          </label>

          @if ($errors->has('SD_water'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_water') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_predial') ? ' has-error' : ''}}">{{-- SD_predial --}}
          <label
            for="SD_predial"
            class="checkbox-inline control-label">
            <input
              name="SD_predial"
              id="SD_predial"
              type="checkbox"
              v-model="sale.seller.predial"
              @if (old('SD_predial'))
                checked
              @endif>@lang('sale.sellers_predial')
          </label>

          @if ($errors->has('SD_predial'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_predial') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_light') ? ' has-error' : ''}}">{{-- SD_light --}}
          <label
            for="SD_light"
            class="checkbox-inline control-label">
            <input
              name="SD_light"
              id="SD_light"
              type="checkbox"
              v-model="sale.seller.light"
              @if (old('SD_light'))
                checked
              @endif>@lang('sale.sellers_light')
          </label>

          @if ($errors->has('SD_light'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_light') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_birth_certificate') ? ' has-error' : ''}}">{{-- SD_birth_certificate --}}
          <label
            for="SD_birth_certificate"
            class="checkbox-inline control-label">
            <input
              name="SD_birth_certificate"
              id="SD_birth_certificate"
              type="checkbox"
              v-model="sale.seller.birth_certificate"
              @if (old('SD_birth_certificate'))
                checked
              @endif>@lang('sale.sellers_birth_certificate')
          </label>

          @if ($errors->has('SD_birth_certificate'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_birth_certificate') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_ID') ? ' has-error' : ''}}">{{-- SD_ID --}}
          <label
            for="SD_ID"
            class="checkbox-inline control-label">
            <input
              name="SD_ID"
              id="SD_ID"
              type="checkbox"
              v-model="sale.seller.ID"
              @if (old('SD_ID'))
                checked
              @endif>@lang('sale.sellers_id')
          </label>

          @if ($errors->has('SD_ID'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_ID') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('SD_CURP') ? ' has-error' : ''}}">{{-- SD_CURP --}}
          <label
            for="SD_CURP"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-1">
            @lang('sale.sellers_curp')
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
            <input
              name="SD_CURP"
              id="SD_CURP"
              class="form-control"
              type="text"
              v-model="sale.seller.CURP"
              value="{{ old('SD_CURP') }}">
          </div>

          @if ($errors->has('SD_CURP'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_CURP') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('SD_RFC') ? ' has-error' : ''}}">{{-- SD_RFC --}}
          <label
            for="SD_RFC"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-1">
            @lang('sale.sellers_rfc')
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
            <input
              name="SD_RFC"
              id="SD_RFC"
              class="form-control"
              type="text"
              v-model="sale.seller.RFC"
              value="{{ old('SD_RFC') }}">
          </div>

          @if ($errors->has('SD_RFC'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_RFC') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('SD_account_status') ? ' has-error' : ''}}">{{-- SD_account_status --}}
          <label
            for="SD_account_status"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-1">
            @lang('sale.sellers_account_status')
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
            <input
              name="SD_account_status"
              id="SD_account_status"
              class="form-control"
              type="text"
              v-model="sale.seller.account_status"
              value="{{ old('SD_account_status') }}">
          </div>

          @if ($errors->has('SD_account_status'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_account_status') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_email') ? ' has-error' : ''}}">{{-- SD_email --}}
          <label
            for="SD_email"
            class="checkbox-inline control-label">
            <input
              name="SD_email"
              id="SD_email"
              type="checkbox"
              v-model="sale.seller.email"
              @if (old('SD_email'))
                checked
              @endif>
            @lang('shared.email')
          </label>

          @if ($errors->has('SD_email'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_email') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_phone') ? ' has-error' : ''}}">{{-- SD_phone --}}
          <label
            for="SD_phone"
            class="checkbox-inline control-label">
            <input
              name="SD_phone"
              id="SD_phone"
              type="checkbox"
              v-model="sale.seller.phone"
              @if (old('SD_phone'))
                checked
              @endif>@lang('shared.phone')
          </label>

          @if ($errors->has('SD_phone'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_phone') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('SD_civil_status') ? ' has-error' : ''}} col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">{{-- SD_civil_status --}}
          <label
            for="SD_civil_status"
            class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">@lang('sale.sellers_civil_status'):</label>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <select
              class="form-control"
              name="SD_civil_status"
              id="SD_civil_status"
              autofocus
              required
              v-model="sale.seller.civil_status">
              <option
                value=""
                disabled
                {{ !old('SD_civil_status')
                  ? 'selected'
                  : '' }}>@lang('shared.choose_an_option')</option>
              <option
                value="Soltero"
                {{ old('SD_civil_status') == 'Soltero'
                  ? 'selected'
                  : '' }}>@lang('sale.sellers_single')</option>
              <option
                value="Casado"
                {{ old('SD_civil_status') == 'Casado'
                    ? 'selected'
                    : '' }}>@lang('sale.sellers_married')</option>
            </select>

            @if ($errors->has('SD_civil_status'))
              <span class="help-block">
                <strong>{{ $errors->first('SD_civil_status') }}</strong>
              </span>
            @endif
          </div>
        </div>
      </fieldset>
    </div>
  </div>
</div>
