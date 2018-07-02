<div class="panel panel-default" v-cloak>
  <div class="panel-heading" role="tab" id="documents">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        @lang('sale.documents')
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse in collapse-in" role="tabpanel" aria-labelledby="documents">
    <div class="panel-body">
      <fieldset>
        <div class="block clearfix form-group{{ $errors->has('internal_expedient_id') ? ' has-error' : ''}}">
          <label
            for="expedient_id"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('call.internal_expedient'): </label>
          <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
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
            <input type="hidden" name="client_id" :value="clientId">
            <input type="hidden" name="expedient" :value="clientExpedient">

            @if ($errors->has('internal_expedient_id'))
              <span class="help-block">
                <strong>{{ $errors->first('internal_expedient_id') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="block row clearfix col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <p class="col-xs-12 col-sm-offset-3 col-sm-9 col-md-offset-3 col-md-9 col-lg-offset-2 col-lg-8" :has-expedient="hasExpedient">
            ¿No encuentras el expediente?
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
          :expedient="clientExpedient"
          :name="fullName"
          :phone-one="clientPhoneOne"
          :phone-two="clientPhoneTwo"
          :business="clientBusiness"
          :email-one="clientEmailOne"
          :email-two="clientEmailTwo"
          :reference="clientReference"
          :has-client="hasClient"
          :empty="empty"
          v-if="!loading"></Expedient>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_deed') ? ' has-error' : ''}}">
          <label
            for="SD_deed"
            class="checkbox-inline control-label">
            <input
              name="SD_deed"
              id="SD_deed"
              type="checkbox"
              v-model="documents.deed"
              @if (
                !empty(old('SD_deed')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_deed))
              )
                checked
              @endif>@lang('sale.documents_deed')
          </label>

          @if ($errors->has('SD_deed'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_deed') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_predial') ? ' has-error' : ''}}">
          <label
            for="SD_predial"
            class="checkbox-inline control-label">
            <input
              name="SD_predial"
              id="SD_predial"
              type="checkbox"
              v-model="documents.predial"
              @if (
                !empty(old('SD_predial')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_predial))
              )
                checked
              @endif>@lang('sale.documents_predial')
          </label>

          @if ($errors->has('SD_predial'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_predial') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_light') ? ' has-error' : ''}}">
          <label
            for="SD_light"
            class="checkbox-inline control-label">
            <input
              name="SD_light"
              id="SD_light"
              type="checkbox"
              v-model="documents.light"
              @if (
                !empty(old('SD_light')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_light))
              )
                checked
              @endif>@lang('sale.documents_light')
          </label>

          @if ($errors->has('SD_light'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_light') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_water') ? ' has-error' : ''}}">
          <label
            for="SD_water"
            class="checkbox-inline control-label">
            <input
              name="SD_water"
              id="SD_water"
              type="checkbox"
              v-model="documents.water"
              @if (
                !empty(old('SD_water')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_water))
              )
                checked
              @endif>@lang('sale.documents_water')
          </label>

          @if ($errors->has('SD_water'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_water') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_generals_sheet') ? ' has-error' : ''}}">
          <label
            for="SD_generals_sheet"
            class="checkbox-inline control-label">
            <input
              name="SD_generals_sheet"
              id="SD_generals_sheet"
              type="checkbox"
              v-model="documents.generals_sheet"
              @if (
                !empty(old('SD_generals_sheet')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_generals_sheet))
              )
                checked
              @endif>@lang('sale.documents_generals_sheet')
          </label>

          @if ($errors->has('SD_generals_sheet'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_generals_sheet') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_INE') ? ' has-error' : ''}}">
          <label
            for="SD_INE"
            class="checkbox-inline control-label">
            <input
              name="SD_INE"
              id="SD_INE"
              type="checkbox"
              v-model="documents.INE"
              @if (
                !empty(old('SD_INE')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_INE))
              )
                checked
              @endif>@lang('sale.documents_ine')
          </label>

          @if ($errors->has('SD_INE'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_INE') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_CURP') ? ' has-error' : ''}}">
          <label
            for="SD_CURP"
            class="checkbox-inline control-label">
            <input
              name="SD_CURP"
              id="SD_CURP"
              type="checkbox"
              v-model="documents.CURP"
              @if (
                !empty(old('SD_CURP')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_CURP))
              )
                checked
              @endif>@lang('sale.documents_curp')
          </label>

          @if ($errors->has('SD_CURP'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_CURP') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_birth_certificate') ? ' has-error' : ''}}">
          <label
            for="SD_birth_certificate"
            class="checkbox-inline control-label">
            <input
              name="SD_birth_certificate"
              id="SD_birth_certificate"
              type="checkbox"
              v-model="documents.birth_certificate"
              @if (
                !empty(old('SD_birth_certificate')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_birth_certificate))
              )
                checked
              @endif>@lang('sale.documents_birth_certificate')
          </label>

          @if ($errors->has('SD_birth_certificate'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_birth_certificate') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_account_status') ? ' has-error' : ''}}">
          <label
            for="SD_account_status"
            class="checkbox-inline control-label">
            <input
              name="SD_account_status"
              id="SD_account_status"
              type="checkbox"
              v-model="documents.account_status"
              @if (
                !empty(old('SD_account_status')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_account_status))
              )
                checked
              @endif>@lang('sale.documents_account_status')
          </label>

          @if ($errors->has('SD_account_status'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_account_status') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_email') ? ' has-error' : ''}}">
          <label
            for="SD_email"
            class="checkbox-inline control-label">
            <input
              name="SD_email"
              id="SD_email"
              type="checkbox"
              v-model="documents.email"
              @if (
                !empty(old('SD_email')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_email))
              )
                checked
              @endif>@lang('shared.email')
          </label>

          @if ($errors->has('SD_email'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_email') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_phone') ? ' has-error' : ''}}">
          <label
            for="SD_phone"
            class="checkbox-inline control-label">
            <input
              name="SD_phone"
              id="SD_phone"
              type="checkbox"
              v-model="documents.phone"
              @if (
                !empty(old('SD_phone')) ||
                ($sale->document !== null &&
                 !empty($sale->document->SD_phone))
              )
                checked
              @endif>@lang('shared.phone')
          </label>

          @if ($errors->has('SD_phone'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_phone') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('SD_civil_status') ? ' has-error' : ''}} col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
          <label
            for="SD_civil_status"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.documents_civil_status'):</label>
          <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
            <select
              class="form-control"
              name="SD_civil_status"
              id="SD_civil_status"
              autofocus
              required
              v-model="documents.civil_status">
              <option
                value=""
                disabled
                {{ (!old('SD_civil_status'))
                  ? 'selected'
                  : '' }}>@lang('shared.choose_an_option')</option>
              <option
                value="Soltero"
                {{ (old('SD_civil_status') == 'Soltero' ||
                   ($sale->document !== null &&
                    $sale->document->SD_civil_status == 'Soltero'))
                ? 'selected'
                : '' }}>@lang('sale.documents_single')</option>
              <option
                value="Casado"
                {{ (old('SD_civil_status') == 'Casado' ||
                   ($sale->document !== null &&
                    $sale->document->SD_civil_status == 'Casado'))
                ? 'selected'
                : '' }}>@lang('sale.documents_married')</option>
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