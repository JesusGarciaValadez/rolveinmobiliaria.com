<div class="panel panel-default" v-if="showNotary" v-cloak>
  <div class="panel-heading">
    <h4 class="panel-title">@lang('sale.notary')</h4>
  </div>
  <div class="panel-body">
    <fieldset>
      <div class="form-group{{ $errors->has('SN_federal_entity') ? ' has-error' : ''}} clearfix">
        <label
          for="SN_federal_entity"
          class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.notary_federal_entity'): </label>
        <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
          <select
            class="form-control"
            name="SN_federal_entity"
            id="SN_federal_entity"
            autofocus
            v-model="notary.federal_entity">
            <option
              value=""
              disabled
              {{ (!old('SN_federal_entity')) ? 'selected' : '' }}>@lang('shared.choose_an_option')</option>
            <option
              value="CDMX"
              {{ (old('SN_federal_entity') == 'CDMX' ||
                 ($sale->notary !== null &&
                  $sale->notary->SN_federal_entity == 'CDMX'))
                  ? 'selected'
                  : '' }}>@lang('shared.cdmx')</option>
            <option
              value="Edo. Mex."
              {{ (old('SN_federal_entity') == 'Edo. Mex.' ||
                 ($sale->notary !== null &&
                  $sale->notary->SN_federal_entity == 'Edo. Mex.'))
                  ? 'selected'
                  : '' }}>@lang('shared.edo_mex')</option>
          </select>

          @if ($errors->has('SN_federal_entity'))
            <span class="help-block">
              <strong>{{ $errors->first('SN_federal_entity') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('SN_notaries_office') ? ' has-error' : ''}} clearfix">
        <label
          for="SN_notaries_office"
          class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.notary_notaries_office'): </label>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
          <input
            type="number"
            class="form-control"
            name="SN_notaries_office"
            id="SN_notaries_office"
            value="{{ (old('SN_notaries_office'))
              ? old('SN_notaries_office')
              : ($sale->notary !== null)
                ? $sale->notary->SN_notaries_office
                : '' }}"
            placeholder="@lang('sale.notary_notaries_office')"
            autocorrect="on"
            v-model="notary.notaries_office">

            @if ($errors->has('SN_notaries_office'))
              <span class="help-block">
                <strong>{{ $errors->first('SN_notaries_office') }}</strong>
              </span>
            @endif
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_freedom_of_lien_certificate') ? ' has-error' : ''}}">
        <label
          for="SN_freedom_of_lien_certificate"
          class="checkbox-inline control-label">
          <input
            name="SN_freedom_of_lien_certificate"
            id="SN_freedom_of_lien_certificate"
            type="checkbox"
            v-model="notary.freedom_of_lien_certificate"
            @if (
              !empty(old('SN_freedom_of_lien_certificate')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_freedom_of_lien_certificate))
            )
              checked
            @endif> @lang('sale.notary_freedom_of_lien_certificate')
        </label>

        @if ($errors->has('SN_freedom_of_lien_certificate'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_freedom_of_lien_certificate') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_zoning') ? ' has-error' : ''}}">
        <label
          for="SN_zoning"
          class="checkbox-inline control-label">
          <input
            name="SN_zoning"
            id="SN_zoning"
            type="checkbox"
            v-model="notary.zoning"
            @if (
              !empty(old('SN_zoning')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_zoning))
            )
              checked
            @endif> @lang('sale.notary_zoning')
        </label>

        @if ($errors->has('SN_zoning'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_zoning') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_water_no_due_constants') ? ' has-error' : ''}}">
        <label
          for="SN_water_no_due_constants"
          class="checkbox-inline control-label">
          <input
            name="SN_water_no_due_constants"
            id="SN_water_no_due_constants"
            type="checkbox"
            v-model="notary.water_no_due_constants"
            @if (
              !empty(old('SN_water_no_due_constants')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_water_no_due_constants))
            )
              checked
            @endif> @lang('sale.notary_water_no_due_constants')
        </label>

        @if ($errors->has('SN_water_no_due_constants'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_water_no_due_constants') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_non_debit_proof_of_property') ? ' has-error' : ''}}">
        <label
          for="SN_non_debit_proof_of_property"
          class="checkbox-inline control-label">
          <input
            name="SN_non_debit_proof_of_property"
            id="SN_non_debit_proof_of_property"
            type="checkbox"
            v-model="notary.non_debit_proof_of_property"
            @if (
              !empty(old('SN_non_debit_proof_of_property')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_non_debit_proof_of_property))
            )
              checked
            @endif> @lang('sale.notary_non_debit_proof_of_property')
        </label>

        @if ($errors->has('SN_non_debit_proof_of_property'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_non_debit_proof_of_property') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_certificate_of_improvement') ? ' has-error' : ''}}">
        <label
          for="SN_certificate_of_improvement"
          class="checkbox-inline control-label">
          <input
            name="SN_certificate_of_improvement"
            id="SN_certificate_of_improvement"
            type="checkbox"
            v-model="notary.certificate_of_improvement"
            @if (
              !empty(old('SN_certificate_of_improvement')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_certificate_of_improvement))
            )
              checked
            @endif> @lang('sale.notary_certificate_of_improvement')
        </label>

        @if ($errors->has('SN_certificate_of_improvement'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_certificate_of_improvement') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_key_and_cadastral_value') ? ' has-error' : ''}}">
        <label
          for="SN_key_and_cadastral_value"
          class="checkbox-inline control-label">
          <input
            name="SN_key_and_cadastral_value"
            id="SN_key_and_cadastral_value"
            type="checkbox"
            v-model="notary.key_and_cadastral_value"
            @if (
              !empty(old('SN_key_and_cadastral_value')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_key_and_cadastral_value))
            )
              checked
            @endif> @lang('sale.notary_key_and_cadastral_value')
        </label>

        @if ($errors->has('SN_key_and_cadastral_value'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_key_and_cadastral_value') }}</strong>
          </span>
        @endif
      </div>
    </fieldset>
  </div>
</div>
