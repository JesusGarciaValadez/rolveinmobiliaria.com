<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">@lang('sale.notary')</h4>
  </div>
  <div class="panel-body">
    <fieldset>
      <div class="form-group{{ $errors->has('SN_federal_entity') ? ' has-error' : ''}} clearfix">{{-- SN_federal_entity --}}
        <label
          for="SN_federal_entity"
          class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.federal_entity'): </label>
        <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
          <select
            class="form-control"
            name="SN_federal_entity"
            id="SN_federal_entity"
            autofocus>
            <option
              value=""
              disabled
              @if (
                !old('SN_federal_entity') &&
                $sale->notary->SN_federal_entity === null
              )
                selected
              @endif>@lang('shared.choose_an_option')</option>
            <option
              value="CDMX"
              @if (
                $sale->notary->SN_federal_entity == 'CDMX' ||
                old('SN_federal_entity') === 'CDMX'
              )
                selected
              @endif>@lang('shared.cdmx')</option>
            <option
              value="Edo. Mex."
              @if (
                $sale->notary->SN_federal_entity === 'Edo. Mex.' ||
                old('SN_federal_entity') === 'Edo. Mex.'
              )
                selected
              @endif>@lang('shared.edo_mex')</option>
          </select>

          @if ($errors->has('SN_federal_entity'))
            <span class="help-block">
              <strong>{{ $errors->first('SN_federal_entity') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('SN_notaries_office') ? ' has-error' : ''}} clearfix">{{-- SN_notaries_office --}}
        <label
          for="SN_notaries_office"
          class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.notaries_office'): </label>
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
            placeholder="@lang('sale.notaries_office')"
            autocorrect="on"
            min="0">

            @if ($errors->has('SN_notaries_office'))
              <span class="help-block">
                <strong>{{ $errors->first('SN_notaries_office') }}</strong>
              </span>
            @endif
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_zoning') ? ' has-error' : ''}}">{{-- SN_zoning --}}
        <label
          for="SN_zoning"
          class="checkbox-inline control-label">
          <input
            name="SN_zoning"
            id="SN_zoning"
            type="checkbox"
            @if (
              !empty(old('SN_zoning')) ||
              ($sale->notary !== null &&
               $sale->notary->SN_zoning !==null)
            )
              checked
            @endif> @lang('sale.zoning')</label>

        @if ($errors->has('SN_zoning'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_zoning') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_water_no_due_constants') ? ' has-error' : ''}}">{{-- SN_water_no_due_constants --}}
        <label
          for="SN_water_no_due_constants"
          class="checkbox-inline control-label">
          <input
            name="SN_water_no_due_constants"
            id="SN_water_no_due_constants"
            type="checkbox"
            @if (
              !empty(old('SN_water_no_due_constants')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_water_no_due_constants))
            )
              checked
            @endif> @lang('sale.water_no_due_constants')</label>

        @if ($errors->has('SN_water_no_due_constants'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_water_no_due_constants') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_non_debit_proof_of_property') ? ' has-error' : ''}}">{{-- SN_non_debit_proof_of_property --}}
        <label
          for="SN_non_debit_proof_of_property"
          class="checkbox-inline control-label">
          <input
            name="SN_non_debit_proof_of_property"
            id="SN_non_debit_proof_of_property"
            type="checkbox"
            @if (
              !empty(old('SN_non_debit_proof_of_property')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_non_debit_proof_of_property))
            )
              checked
            @endif> @lang('sale.non_debit_proof_of_property')</label>

        @if ($errors->has('SN_non_debit_proof_of_property'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_non_debit_proof_of_property') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_certificate_of_improvement') ? ' has-error' : ''}}">{{-- SN_certificate_of_improvement --}}
        <label
          for="SN_certificate_of_improvement"
          class="checkbox-inline control-label">
          <input
            name="SN_certificate_of_improvement"
            id="SN_certificate_of_improvement"
            type="checkbox"
            @if (
              !empty(old('SN_certificate_of_improvement')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_certificate_of_improvement))
            )
              checked
            @endif> @lang('sale.certificate_of_improvement')</label>

        @if ($errors->has('SN_certificate_of_improvement'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_certificate_of_improvement') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SN_key_and_cadastral_value') ? ' has-error' : ''}}">{{-- SN_key_and_cadastral_value --}}
        <label
          for="SN_key_and_cadastral_value"
          class="checkbox-inline control-label">
          <input
            name="SN_key_and_cadastral_value"
            id="SN_key_and_cadastral_value"
            type="checkbox"
            @if (
              !empty(old('SN_key_and_cadastral_value')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_key_and_cadastral_value))
            )
              checked
            @endif> @lang('sale.key_and_cadastral_value')</label>

        @if ($errors->has('SN_key_and_cadastral_value'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_key_and_cadastral_value') }}</strong>
          </span>
        @endif
      </div>
    </fieldset>
    <fieldset>
      <legend>@lang('sale.follow_up_of_the_certificate_of_freedom_of_lien')</legend>
      <div class="col-xs-12 form-group{{ $errors->has('SN_date_freedom_of_lien_certificate') ? ' has-error' : ''}}">{{-- SN_date_freedom_of_lien_certificate --}}
        <label
          for="SN_date_freedom_of_lien_certificate"
          class="control-label col-xs-12 col-sm-4">@lang('sale.date_freedom_of_lien_certificate')</label>
        <div class="col-xs-12 col-sm-8">
          <input
            class="form-control"
            name="SN_date_freedom_of_lien_certificate"
            id="SN_date_freedom_of_lien_certificate"
            type="date"
            placeholder="aaaa-mm-dd"
            pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
            @if (old('SN_date_freedom_of_lien_certificate'))
              value="{{ old('SN_date_freedom_of_lien_certificate') }}"
            @elseif ($sale->notary->SN_date_freedom_of_lien_certificate)
              value="{{ $sale->notary->SN_date_freedom_of_lien_certificate }}"
            @endif>
        </div>

        @if ($errors->has('SN_date_freedom_of_lien_certificate'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_date_freedom_of_lien_certificate') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 form-group{{ $errors->has('SN_observations_freedom_of_lien_certificate') ? ' has-error' : ''}}">{{-- SN_observations_freedom_of_lien_certificate --}}
        <label
          for="SN_observations_freedom_of_lien_certificate"
          class="control-label col-xs-12">@lang('sale.observations_freedom_of_lien_certificate')</label>

        <div class="col-xs-12">
          <textarea
            class="form-control"
            name="SN_observations_freedom_of_lien_certificate"
            id="SN_observations_freedom_of_lien_certificate">{{
              old('SN_observations_freedom_of_lien_certificate')
                ? old('SN_observations_freedom_of_lien_certificate')
                : $sale->notary->SN_observations_freedom_of_lien_certificate
                  ? $sale->notary->SN_observations_freedom_of_lien_certificate
                  : '' }}</textarea>
        </div>

        @if ($errors->has('SN_observations_freedom_of_lien_certificate'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_observations_freedom_of_lien_certificate') }}</strong>
          </span>
        @endif
      </div>
    </fieldset>
    <fieldset>
      <legend>@lang('sale.expedient')</legend>
      <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-0 form-group{{ $errors->has('SN_seller_documents') ? ' has-error' : ''}}">{{-- SN_seller_documents --}}
        <label
          for="SN_seller_documents"
          class="checkbox-inline control-label">
          <input
            name="SN_seller_documents"
            id="SN_seller_documents"
            type="checkbox"
            @if (
              !empty(old('SN_seller_documents')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_seller_documents))
            )
              checked
            @endif> @lang('sale.seller_documents')</label>

        @if ($errors->has('SN_seller_documents'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_seller_documents') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-0 form-group{{ $errors->has('SN_buyer_documents') ? ' has-error' : ''}}">{{-- SN_buyer_documents --}}
        <label
          for="SN_buyer_documents"
          class="checkbox-inline control-label">
          <input
            name="SN_buyer_documents"
            id="SN_buyer_documents"
            type="checkbox"
            @if (
              !empty(old('SN_buyer_documents')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_buyer_documents))
            )
              checked
            @endif> @lang('sale.buyer_documents')</label>

        @if ($errors->has('SN_buyer_documents'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_buyer_documents') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-0 form-group{{ $errors->has('SN_activation_documents_for_the_mortgage_loan') ? ' has-error' : ''}}">{{-- SN_activation_documents_for_the_mortgage_loan --}}
        <label
          for="SN_activation_documents_for_the_mortgage_loan"
          class="checkbox-inline control-label">
          <input
            name="SN_activation_documents_for_the_mortgage_loan"
            id="SN_activation_documents_for_the_mortgage_loan"
            type="checkbox"
            @if (
              !empty(old('SN_activation_documents_for_the_mortgage_loan')) ||
              ($sale->notary !== null &&
               !empty($sale->notary->SN_activation_documents_for_the_mortgage_loan))
            )
              checked
            @endif> @lang('sale.activation_documents_for_the_mortgage_loan')</label>

        @if ($errors->has('SN_activation_documents_for_the_mortgage_loan'))
          <span class="help-block">
            <strong>{{ $errors->first('SN_activation_documents_for_the_mortgage_loan') }}</strong>
          </span>
        @endif
      </div>
    </fieldset>
  </div>
</div>
