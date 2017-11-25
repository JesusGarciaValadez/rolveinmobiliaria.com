<div class="panel panel-default">
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
        <input type="hidden" name="user_id" value="{{ $sale->user->id }}">

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_predial') ? ' has-error' : ''}}">
          <label
            for="SD_predial"
            class="checkbox-inline control-label">
            <input
              name="SD_predial"
              type="checkbox"
              required
              v-model="documents.predial.default"
              @if (
                !empty(old($sale->document->SD_predial)) ||
                !empty($sale->document->SD_predial)
              )
                checked
              @endif> @lang('sale.documents_predial')
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
              type="checkbox"
              value="1"
              required
              v-model="documents.light.default"
              @if (
                !empty(old($sale->document->SD_light)) ||
                !empty($sale->document->SD_light)
                )
                checked
              @endif> @lang('sale.documents_light')
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
              type="checkbox"
              value="1"
              required
              v-model="documents.water.default"
              @if (
                !empty(old($sale->document->SD_water)) ||
                !empty($sale->document->SD_water)
                )
                checked
              @endif> @lang('sale.documents_water')
          </label>

          @if ($errors->has('SD_water'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_water') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_deed') ? ' has-error' : ''}}">
          <label
            for="SD_deed"
            class="checkbox-inline control-label">
            <input
              name="SD_deed"
              type="checkbox"
              value="1"
              required
              v-model="documents.deed.default"
              @if (
                !empty(old($sale->document->SD_deed)) ||
                !empty($sale->document->SD_deed)
                )
                checked
              @endif> @lang('sale.documents_deed')
          </label>

          @if ($errors->has('SD_deed'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_deed') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_general_sheet') ? ' has-error' : ''}}">
          <label
            for="SD_general_sheet"
            class="checkbox-inline control-label">
            <input
              name="SD_general_sheet"
              type="checkbox"
              value="1"
              v-model="documents.general_sheet.default"
              @if (
                !empty(old($sale->document->SD_general_sheet)) ||
                !empty($sale->document->SD_general_sheet)
                )
                checked
              @endif> @lang('sale.documents_general_sheet')
          </label>

          @if ($errors->has('SD_general_sheet'))
            <span class="help-block">
              <strong>{{ $errors->first('SD_general_sheet') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SD_INE') ? ' has-error' : ''}}">
          <label
            for="SD_INE"
            class="checkbox-inline control-label">
            <input
              name="SD_INE"
              type="checkbox"
              value="1"
              v-model="documents.INE.default"
              @if (
                !empty(old($sale->document->SD_INE)) ||
                !empty($sale->document->SD_INE)
                )
                checked
              @endif> @lang('sale.documents_ine')
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
              type="checkbox"
              value="1"
              v-model="documents.CURP.default"
              @if (
                !empty(old($sale->document->SD_CURP)) ||
                !empty($sale->document->SD_CURP)
                )
                checked
              @endif> @lang('sale.documents_curp')
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
              type="checkbox"
              value="1"
              v-model="documents.birth_certificate.default"
              @if (
                !empty(old($sale->document->SD_birth_certificate)) ||
                !empty($sale->document->SD_birth_certificate)
                )
                checked
              @endif> @lang('sale.documents_birth_certificate')
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
              type="checkbox"
              value="1"
              v-model="documents.account_status.default"
              @if (
                !empty(old($sale->document->SD_account_status)) ||
                !empty($sale->document->SD_account_status)
                )
                checked
              @endif> @lang('sale.documents_account_status')
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
              type="checkbox"
              value="1"
              v-model="documents.email.default"
              @if (
                !empty(old($sale->document->SD_email)) ||
                !empty($sale->document->SD_email)
                )
                checked
              @endif> @lang('shared.email')
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
              type="checkbox"
              value="1"
              v-model="documents.phone.default"
              @if (
                !empty(old($sale->document->SD_phone)) ||
                !empty($sale->document->SD_phone)
                )
                checked
              @endif> @lang('shared.phone')
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
              id="SD_civil_status"
              name="SD_civil_status"
              autofocus
              required
              v-model="documents.civil_status.default">
              <option
                value=""
                disabled
                {{ (!old('SD_civil_status'))
                  ? 'selected'
                  : '' }}>@lang('shared.choose_an_option')</option>
              <option
                value="Soltero"
                {{ (old('SD_civil_status') == 'Soltero'
                || $sale->document->SD_civil_status == 'Soltero')
                ? 'selected'
                : '' }}>@lang('sale.documents_single')</option>
              <option
                value="Casado"
                {{ (old('SD_civil_status') == 'Casado'
                || $sale->document->SD_civil_status == 'Casado')
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
