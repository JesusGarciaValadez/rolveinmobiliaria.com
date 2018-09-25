<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">@lang('sale.contract')</h4>
  </div>
  <div class="panel-body">
    <fieldset>
      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_general_buyer') ? ' has-error' : ''}}">
        <label
          for="SC_general_buyer"
          class="checkbox-inline control-label">
          <input
            name="SC_general_buyer"
            id="SC_general_buyer"
            type="checkbox"
            v-model="contract.general_buyer"
            @if (
              !empty(old('SC_general_buyer')) ||
              ($sale->contract !== null &&
               !empty($sale->contract->SC_general_buyer))
            )
              checked
            @endif> @lang('sale.contract_general_buyer')
        </label>

        @if ($errors->has('SC_general_buyer'))
          <span class="help-block">
            <strong>{{ $errors->first('SC_general_buyer') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_purchase_agreements') ? ' has-error' : ''}}">
        <label
          for="SC_purchase_agreements"
          class="checkbox-inline control-label">
          <input
            name="SC_purchase_agreements"
            id="SC_purchase_agreements"
            type="checkbox"
            v-model="contract.purchase_agreements"
            @if (
              !empty(old('SC_purchase_agreements')) ||
              ($sale->contract !== null &&
               !empty($sale->contract->SC_purchase_agreements))
            )
              checked
            @endif> @lang('sale.contract_purchase_agreements')
        </label>

        @if ($errors->has('SC_purchase_agreements'))
          <span class="help-block">
            <strong>{{ $errors->first('SC_purchase_agreements') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_tax_assessment') ? ' has-error' : ''}}">
        <label
          for="SC_tax_assessment"
          class="checkbox-inline control-label">
          <input
            name="SC_tax_assessment"
            id="SC_tax_assessment"
            type="checkbox"
            v-model="contract.tax_assessment"
            @if (
              !empty(old('SC_tax_assessment')) ||
              ($sale->contract !== null &&
               !empty($sale->contract->SC_tax_assessment))
            )
              checked
            @endif> @lang('sale.contract_tax_assessment')
        </label>

        @if ($errors->has('SC_tax_assessment'))
          <span class="help-block">
            <strong>{{ $errors->first('SC_tax_assessment') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_notary_checklist') ? ' has-error' : ''}}">
        <label
          for="SC_notary_checklist"
          class="checkbox-inline control-label">
          <input
            name="SC_notary_checklist"
            id="SC_notary_checklist"
            type="checkbox"
            v-model="contract.notary_checklist"
            @if (
              !empty(old('SC_notary_checklist')) ||
              ($sale->contract !== null &&
               !empty($sale->contract->SC_notary_checklist))
            )
              checked
            @endif> @lang('sale.contract_notary_checklist')
        </label>

        @if ($errors->has('SC_notary_checklist'))
          <span class="help-block">
            <strong>{{ $errors->first('SC_notary_checklist') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_notary_file') ? ' has-error' : ''}}">
        <label
          for="SC_notary_file"
          class="checkbox-inline control-label">
          <input
            name="SC_notary_file"
            id="SC_notary_file"
            type="checkbox"
            v-model="contract.notary_file"
            @if (
              !empty(old('SC_notary_file')) ||
              ($sale->contract !== null &&
               !empty($sale->contract->SC_notary_file))
            )
              checked
            @endif> @lang('sale.contract_notary_file')
        </label>

        @if ($errors->has('SC_notary_file'))
          <span class="help-block">
            <strong>{{ $errors->first('SC_notary_file') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('SC_mortgage_credit') ? ' has-error' : ''}} col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
        <label
          for="SC_mortgage_credit"
          class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.contract_contract_mortgage_credit'): </label>
        <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
          <select
            class="form-control"
            name="SC_mortgage_credit"
            id="SC_mortgage_credit"
            autofocus
            v-model="contract.mortgage_credit">
            <option
              value=""
              disabled
              {{ (old('SC_mortgage_credit') === '')
                ? 'selected'
                : ($sale->contract === null ||
                   $sale->contract->SC_mortgage_credit === null)
                   ? 'selected'
                   : '' }}>@lang('shared.choose_an_option')</option>
            <option
              value="INFONAVIT"
              {{ (old('SC_mortgage_credit') === 'INFONAVIT')
                ? 'selected'
                : ($sale->contract !== null &&
                   $sale->contract->SC_mortgage_credit === 'INFONAVIT')
                   ? 'selected'
                   : '' }}>@lang('sale.contract_infonavit')</option>
            <option
              value="FOVISSSTE"
              {{ (old('SC_mortgage_credit') === 'FOVISSSTE')
                ? 'selected'
                : ($sale->contract !== null &&
                   $sale->contract->SC_mortgage_credit === 'FOVISSSTE')
                   ? 'selected'
                   : '' }}>@lang('sale.contract_fovissste')</option>
            <option
              value="COFINAVIT"
              {{ (old('SC_mortgage_credit') === 'COFINAVIT')
                ? 'selected'
                : ($sale->contract !== null &&
                   $sale->contract->SC_mortgage_credit === 'COFINAVIT')
                   ? 'selected'
                   : '' }}>@lang('sale.contract_cofinavit')</option>
            <option
              value="Bancario"
              {{ (old('SC_mortgage_credit') === 'Bancario')
                ? 'selected'
                : ($sale->contract !== null &&
                   $sale->contract->SC_mortgage_credit === 'Bancario')
                   ? 'selected'
                   : '' }}>@lang('shared.banking')</option>
            <option
              value="Aliados"
              {{ (old('SC_mortgage_credit') === 'Aliados')
                ? 'selected'
                : ($sale->contract !== null &&
                   $sale->contract->SC_mortgage_credit === 'Aliados')
                   ? 'selected'
                   : '' }}>@lang('shared.allies')</option>
          </select>

          @if ($errors->has('SC_mortgage_credit'))
            <span class="help-block">
              <strong>{{ $errors->first('SC_mortgage_credit') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix infonavit_contract" v-if="isInfonavit">
        <legend class="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix">INFONAVIT</legend>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_certified_birth_certificate') ? ' has-error' : ''}}">
          <label
            for="IC_certified_birth_certificate"
            class="checkbox-inline control-label">
            <input
              name="IC_certified_birth_certificate"
              id="IC_certified_birth_certificate"
              type="checkbox"
              v-model="contract.infonavit.certified_birth_certificate"
              @if (
                !empty(old('IC_certified_birth_certificate')) ||
                (($sale->contract !== null &&
                  $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_certified_birth_certificate))
              )
                checked
              @endif> @lang('shared.certified_birth_certificate')
          </label>

          @if ($errors->has('IC_certified_birth_certificate'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_certified_birth_certificate') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_official_ID') ? ' has-error' : ''}}">
          <label
            for="IC_official_ID"
            class="checkbox-inline control-label">
            <input
              name="IC_official_ID"
              id="IC_official_ID"
              type="checkbox"
              v-model="contract.infonavit.official_ID"
              @if (
                !empty(old('IC_official_ID')) ||
                (($sale->contract !== null &&
                  $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_official_ID))
              )
                checked
              @endif> @lang('shared.official_ID')
          </label>

          @if ($errors->has('IC_official_ID'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_official_ID') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_curp') ? ' has-error' : ''}}">
          <label
            for="IC_curp"
            class="checkbox-inline control-label">
            <input
              name="IC_curp"
              id="IC_curp"
              type="checkbox"
              v-model="contract.infonavit.curp"
              @if (
                !empty(old('IC_curp')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_curp))
              )
                checked
              @endif> @lang('shared.CURP')
          </label>

          @if ($errors->has('IC_curp'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_curp') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_rfc') ? ' has-error' : ''}}">
          <label
            for="IC_rfc"
            class="checkbox-inline control-label">
            <input
              name="IC_rfc"
              id="IC_rfc"
              type="checkbox"
              v-model="contract.infonavit.rfc"
              @if (
                !empty(old('IC_rfc')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_rfc))
              )
                checked
              @endif> @lang('shared.RFC')
          </label>

          @if ($errors->has('IC_rfc'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_rfc') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_credit_simulator') ? ' has-error' : ''}}">
          <label
            for="IC_credit_simulator"
            class="checkbox-inline control-label">
            <input
              name="IC_credit_simulator"
              id="IC_credit_simulator"
              type="checkbox"
              v-model="contract.infonavit.credit_simulator"
              @if (
                !empty(old('IC_credit_simulator')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_credit_simulator))
              )
                checked
              @endif> @lang('sale.contract_infonavit_credit_simulator')
          </label>

          @if ($errors->has('IC_credit_simulator'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_credit_simulator') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_credit_application') ? ' has-error' : ''}}">
          <label
            for="IC_credit_application"
            class="checkbox-inline control-label">
            <input
              name="IC_credit_application"
              id="IC_credit_application"
              type="checkbox"
              v-model="contract.infonavit.credit_application"
              @if (
                !empty(old('IC_credit_application')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_credit_application))
              )
                checked
              @endif> @lang('sale.contract_infonavit_credit_application')
          </label>

          @if ($errors->has('IC_credit_application'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_credit_application') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_tax_valuation') ? ' has-error' : ''}}">
          <label
            for="IC_tax_valuation"
            class="checkbox-inline control-label">
            <input
              name="IC_tax_valuation"
              id="IC_tax_valuation"
              type="checkbox"
              v-model="contract.infonavit.tax_valuation"
              @if (
                !empty(old('IC_tax_valuation')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_tax_valuation))
              )
                checked
              @endif> @lang('sale.contract_infonavit_tax_valuation')
          </label>

          @if ($errors->has('IC_tax_valuation'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_tax_valuation') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_bank_statement') ? ' has-error' : ''}}">
          <label
            for="IC_bank_statement"
            class="checkbox-inline control-label">
            <input
              name="IC_bank_statement"
              id="IC_bank_statement"
              type="checkbox"
              v-model="contract.infonavit.bank_statement"
              @if (
                !empty(old('IC_bank_statement')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_bank_statement))
              )
                checked
              @endif> @lang('sale.contract_infonavit_bank_statement')
          </label>

          @if ($errors->has('IC_bank_statement'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_bank_statement') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_workshop_knowing_how_to_decide') ? ' has-error' : ''}}">
          <label
            for="IC_workshop_knowing_how_to_decide"
            class="checkbox-inline control-label">
            <input
              name="IC_workshop_knowing_how_to_decide"
              id="IC_workshop_knowing_how_to_decide"
              type="checkbox"
              v-model="contract.infonavit.workshop_knowing_how_to_decide"
              @if (
                !empty(old('IC_workshop_knowing_how_to_decide')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_workshop_knowing_how_to_decide))
              )
                checked
              @endif> @lang('sale.contract_infonavit_workshop_knowing_how_to_decide')
          </label>

          @if ($errors->has('IC_workshop_knowing_how_to_decide'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_workshop_knowing_how_to_decide') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_retention_sheet') ? ' has-error' : ''}}">
          <label
            for="IC_retention_sheet"
            class="checkbox-inline control-label">
            <input
              name="IC_retention_sheet"
              id="IC_retention_sheet"
              type="checkbox"
              v-model="contract.infonavit.retention_sheet"
              @if (
                !empty(old('IC_retention_sheet')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_retention_sheet))
              )
                checked
              @endif> @lang('sale.contract_infonavit_retention_sheet')
          </label>

          @if ($errors->has('IC_retention_sheet'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_retention_sheet') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_credit_activation') ? ' has-error' : ''}}">
          <label
            for="IC_credit_activation"
            class="checkbox-inline control-label">
            <input
              name="IC_credit_activation"
              id="IC_credit_activation"
              type="checkbox"
              v-model="contract.infonavit.credit_activation"
              @if (
                !empty(old('IC_credit_activation')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) &&
                 !empty($sale->contract->infonavit_contract->IC_credit_activation))
              )
                checked
              @endif> @lang('sale.contract_infonavit_credit_activation')
          </label>

          @if ($errors->has('IC_credit_activation'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_credit_activation') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_credit_maturity') ? ' has-error' : ''}}">
          <label
            for="IC_credit_maturity"
            class="checkbox-inline control-label">
            <input
              name="IC_credit_maturity"
              id="IC_credit_maturity"
              type="checkbox"
              v-model="contract.infonavit.credit_maturity"
              @if (
                !empty(old('IC_credit_maturity')) ||
                (($sale->contract !== null &&
                   $sale->contract->infonavit_contract !== null) && !empty($sale->contract->infonavit_contract->IC_credit_maturity))
              )
                checked
              @endif> @lang('sale.contract_infonavit_credit_maturity')
          </label>

          @if ($errors->has('IC_credit_maturity'))
            <span class="help-block">
              <strong>{{ $errors->first('IC_credit_maturity') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('IC_type') ? ' has-error' : ''}} col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
          <label
            for="IC_type"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('shared.type'): </label>
          <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
            <select
              class="form-control"
              name="IC_type"
              id="IC_type"
              v-model="contract.infonavit.type">
              <option
                value=""
                disabled>@lang('shared.choose_an_option')</option>
              <option
                value="Individual"
                {{ (old('IC_type') === 'Individual')
                  ? 'selected'
                  : (($sale->contract !== null &&
                     $sale->contract->infonavit_contract !== null) &&
                     $sale->contract->infonavit_contract->IC_type == 'Individual')
                     ? 'selected'
                     : '' }}>@lang('shared.individual')</option>
              <option
                value="Conyugal"
                {{ (old('IC_type') === 'Conyugal')
                  ? 'selected'
                  : (($sale->contract !== null &&
                     $sale->contract->infonavit_contract !== null) &&
                     $sale->contract->infonavit_contract->IC_type == 'Conyugal')
                     ? 'selected'
                     : '' }}>@lang('shared.conyugal')</option>
            </select>

            @if ($errors->has('IC_type'))
              <span class="help-block">
                <strong>{{ $errors->first('IC_type') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div id="infonavit_contract_conyugal" v-if="isInfonavitMarried">
          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_spouses_birth_certificate') ? ' has-error' : ''}}">
            <label
              for="IC_spouses_birth_certificate"
              class="checkbox-inline control-label">
              <input
                name="IC_spouses_birth_certificate"
                id="IC_spouses_birth_certificate"
                type="checkbox"
                v-model="contract.infonavit.spouses_birth_certificate"
                @if (
                  !empty(old('IC_spouses_birth_certificate')) ||
                  (($sale->contract !== null &&
                    $sale->contract->infonavit_contract !== null) &&
                    !empty($sale->contract->infonavit_contract->IC_spouses_birth_certificate))
                )
                  checked
                @endif> @lang('shared.birth_certificate')
            </label>

            @if ($errors->has('IC_spouses_birth_certificate'))
              <span class="help-block">
                <strong>{{ $errors->first('IC_spouses_birth_certificate') }}</strong>
              </span>
            @endif
          </div>

          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_official_identification_of_the_spouse') ? ' has-error' : ''}}">
            <label
              for="IC_official_identification_of_the_spouse"
              class="checkbox-inline control-label">
              <input
                name="IC_official_identification_of_the_spouse"
                id="IC_official_identification_of_the_spouse"
                type="checkbox"
                v-model="contract.infonavit.official_identification_of_the_spouse"
                @if (
                  !empty(old('IC_official_identification_of_the_spouse')) ||
                  (($sale->contract !== null &&
                    $sale->contract->infonavit_contract !== null) &&
                    !empty($sale->contract->infonavit_contract->IC_official_identification_of_the_spouse))
                  )
                  checked
                @endif> @lang('sale.contract_infonavit_official_identification_of_the_spouse')
            </label>

            @if ($errors->has('IC_official_identification_of_the_spouse'))
              <span class="help-block">
                <strong>{{ $errors->first('IC_official_identification_of_the_spouse') }}</strong>
              </span>
            @endif
          </div>

          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_marriage_certificate') ? ' has-error' : ''}}">
            <label
              for="IC_marriage_certificate"
              class="checkbox-inline control-label">
              <input
                name="IC_marriage_certificate"
                id="IC_marriage_certificate"
                type="checkbox"
                v-model="contract.infonavit.marriage_certificate"
                @if (
                  !empty(old('IC_marriage_certificate')) ||
                  (($sale->contract !== null &&
                    $sale->contract->infonavit_contract !== null) &&
                    !empty($sale->contract->infonavit_contract->IC_marriage_certificate))
                  )
                  checked
                @endif> @lang('sale.contract_infonavit_marriage_certificate')
            </label>

            @if ($errors->has('IC_marriage_certificate'))
              <span class="help-block">
                <strong>{{ $errors->first('IC_marriage_certificate') }}</strong>
              </span>
            @endif
          </div>
        </div>
      </div>

      <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix fovissste_contract" v-if="isFovissste">
        <legend class="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix">FOVISSSTE</legend>
        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_credit_simulator') ? ' has-error' : ''}}">
          <label
            for="FC_credit_simulator"
            class="checkbox-inline control-label">
            <input
              name="FC_credit_simulator"
              id="FC_credit_simulator"
              type="checkbox"
              v-model="contract.fovissste.credit_simulator"
              @if (
                !empty(old('FC_credit_simulator')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_credit_simulator))
              )
                checked
              @endif> @lang('sale.contract_fovissste_credit_simulator')
          </label>

          @if ($errors->has('FC_credit_simulator'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_credit_simulator') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_curp') ? ' has-error' : ''}}">
          <label
            for="FC_curp"
            class="checkbox-inline control-label">
            <input
              name="FC_curp"
              id="FC_curp"
              type="checkbox"
              v-model="contract.fovissste.curp"
              @if (
                !empty(old('FC_curp')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_curp))
              )
                checked
              @endif> @lang('shared.CURP')
          </label>

          @if ($errors->has('FC_curp'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_curp') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_birth_certificate') ? ' has-error' : ''}}">
          <label
            for="FC_birth_certificate"
            class="checkbox-inline control-label">
            <input
              name="FC_birth_certificate"
              id="FC_birth_certificate"
              type="checkbox"
              v-model="contract.fovissste.birth_certificate"
              @if (
                !empty(old('FC_birth_certificate')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_birth_certificate))
              )
                checked
              @endif> @lang('shared.birth_certificate')
          </label>

          @if ($errors->has('FC_birth_certificate'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_birth_certificate') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_bank_statement') ? ' has-error' : ''}}">
          <label
            for="FC_bank_statement"
            class="checkbox-inline control-label">
            <input
              name="FC_bank_statement"
              id="FC_bank_statement"
              type="checkbox"
              v-model="contract.fovissste.bank_statement"
              @if (
                !empty(old('FC_bank_statement')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_bank_statement))
              )
                checked
              @endif> @lang('sale.contract_fovissste_bank_statement')
          </label>

          @if ($errors->has('FC_bank_statement'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_bank_statement') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_single_key_housing_payment') ? ' has-error' : ''}}">
          <label
            for="FC_single_key_housing_payment"
            class="checkbox-inline control-label">
            <input
              name="FC_single_key_housing_payment"
              id="FC_single_key_housing_payment"
              type="checkbox"
              v-model="contract.fovissste.single_key_housing_payment"
              @if (
                !empty(old('FC_single_key_housing_payment')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_single_key_housing_payment))
              )
                checked
              @endif> @lang('sale.contract_fovissste_single_key_housing_payment')
          </label>

          @if ($errors->has('FC_single_key_housing_payment'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_single_key_housing_payment') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_general_buyers_and_sellers') ? ' has-error' : ''}}">
          <label
            for="FC_general_buyers_and_sellers"
            class="checkbox-inline control-label">
            <input
              name="FC_general_buyers_and_sellers"
              id="FC_general_buyers_and_sellers"
              type="checkbox"
              v-model="contract.fovissste.general_buyers_and_sellers"
              @if (
                !empty(old('FC_general_buyers_and_sellers')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_general_buyers_and_sellers))
              )
                checked
              @endif> @lang('sale.contract_fovissste_general_buyers_and_sellers')
          </label>

          @if ($errors->has('FC_general_buyers_and_sellers'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_general_buyers_and_sellers') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_education_course') ? ' has-error' : ''}}">
          <label
            for="FC_education_course"
            class="checkbox-inline control-label">
            <input
              name="FC_education_course"
              id="FC_education_course"
              type="checkbox"
              v-model="contract.fovissste.education_course"
              @if (
                !empty(old('FC_education_course')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_education_course))
              )
                checked
              @endif> @lang('sale.contract_fovissste_education_course')
          </label>

          @if ($errors->has('FC_education_course'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_education_course') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_last_pay_stub') ? ' has-error' : ''}}">
          <label
            for="FC_last_pay_stub"
            class="checkbox-inline control-label">
            <input
              name="FC_last_pay_stub"
              id="FC_last_pay_stub"
              type="checkbox"
              v-model="contract.fovissste.last_pay_stub"
              @if (
                !empty(old('FC_last_pay_stub')) ||
                (($sale->contract !== null &&
                  $sale->contract->fovissste_contract !== null) &&
                  !empty($sale->contract->fovissste_contract->FC_last_pay_stub))
              )
                checked
              @endif> @lang('sale.contract_fovissste_last_pay_stub')
          </label>

          @if ($errors->has('FC_last_pay_stub'))
            <span class="help-block">
              <strong>{{ $errors->first('FC_last_pay_stub') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix cofinavit_contract" v-if="isCofinavit">
        <legend class="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix">COFINAVIT</legend>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_request_for_credit_inspection') ? ' has-error' : ''}}">
          <label
            for="CC_request_for_credit_inspection"
            class="checkbox-inline control-label">
            <input
              name="CC_request_for_credit_inspection"
              id="CC_request_for_credit_inspection"
              type="checkbox"
              v-model="contract.cofinavit.request_for_credit_inspection"
              @if (
                !empty(old('CC_request_for_credit_inspection')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_request_for_credit_inspection))
              )
                checked
              @endif> @lang('sale.contract_cofinavit_request_for_credit_inspection')
          </label>

          @if ($errors->has('CC_request_for_credit_inspection'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_request_for_credit_inspection') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_birth_certificate') ? ' has-error' : ''}}">
          <label
            for="CC_birth_certificate"
            class="checkbox-inline control-label">
            <input
              name="CC_birth_certificate"
              id="CC_birth_certificate"
              type="checkbox"
              v-model="contract.cofinavit.birth_certificate"
              @if (
                !empty(old('CC_birth_certificate')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_birth_certificate))
              )
                checked
              @endif> @lang('shared.birth_certificate')
          </label>

          @if ($errors->has('CC_birth_certificate'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_birth_certificate') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_official_id') ? ' has-error' : ''}}">
          <label
            for="CC_official_id"
            class="checkbox-inline control-label">
            <input
              name="CC_official_id"
              id="CC_official_id"
              type="checkbox"
              v-model="contract.cofinavit.official_id"
              @if (
                !empty(old('CC_official_id')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_official_id))
              )
                checked
              @endif> @lang('shared.official_ID')
          </label>

          @if ($errors->has('CC_official_id'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_official_id') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_curp') ? ' has-error' : ''}}">
          <label
            for="CC_curp"
            class="checkbox-inline control-label">
            <input
              name="CC_curp"
              id="CC_curp"
              type="checkbox"
              v-model="contract.cofinavit.curp"
              @if (
                !empty(old('CC_curp')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_curp))
              )
                checked
              @endif> @lang('shared.CURP')
          </label>

          @if ($errors->has('CC_curp'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_curp') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_rfc') ? ' has-error' : ''}}">
          <label
            for="CC_rfc"
            class="checkbox-inline control-label">
            <input
              name="CC_rfc"
              id="CC_rfc"
              type="checkbox"
              v-model="contract.cofinavit.rfc"
              @if (
                !empty(old('CC_rfc')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_rfc))
              )
                checked
              @endif> @lang('shared.RFC')
          </label>

          @if ($errors->has('CC_rfc'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_rfc') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_bank_statement_seller') ? ' has-error' : ''}}">
          <label
            for="CC_bank_statement_seller"
            class="checkbox-inline control-label">
            <input
              name="CC_bank_statement_seller"
              id="CC_bank_statement_seller"
              type="checkbox"
              v-model="contract.cofinavit.bank_statement_seller"
              @if (
                !empty(old('CC_bank_statement_seller')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_bank_statement_seller))
              )
                checked
              @endif> @lang('sale.contract_cofinavit_bank_statement_seller')
          </label>

          @if ($errors->has('CC_bank_statement_seller'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_bank_statement_seller') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_tax_valuation') ? ' has-error' : ''}}">
          <label
            for="CC_tax_valuation"
            class="checkbox-inline control-label">
            <input
              name="CC_tax_valuation"
              id="CC_tax_valuation"
              type="checkbox"
              v-model="contract.cofinavit.tax_valuation"
              @if (
                !empty(old('CC_tax_valuation')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_tax_valuation))
              )
                checked
              @endif> @lang('sale.contract_cofinavit_tax_valuation')
          </label>

          @if ($errors->has('CC_tax_valuation'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_tax_valuation') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_scripture_copy') ? ' has-error' : ''}}">
          <label
            for="CC_scripture_copy"
            class="checkbox-inline control-label">
            <input
              name="CC_scripture_copy"
              id="CC_scripture_copy"
              type="checkbox"
              v-model="contract.cofinavit.scripture_copy"
              @if (
                !empty(old('CC_scripture_copy')) ||
                (($sale->contract !== null &&
                  $sale->contract->cofinavit_contract !== null) &&
                  !empty($sale->contract->cofinavit_contract->CC_scripture_copy))
              )
                checked
              @endif> @lang('sale.contract_cofinavit_scripture_copy')
          </label>

          @if ($errors->has('CC_scripture_copy'))
            <span class="help-block">
              <strong>{{ $errors->first('CC_scripture_copy') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('CC_type') ? ' has-error' : ''}} col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
          <label
            for="CC_type"
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('shared.type'): </label>
          <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
            <select
              class="form-control"
              name="CC_type"
              id="CC_type"
              v-model="contract.cofinavit.type">
              <option
                value=""
                disabled>@lang('shared.choose_an_option')</option>
              <option
                value="Individual"
                {{ (old('CC_type') == 'Individual')
                  ? 'selected'
                  : (($sale->contract !== null &&
                    $sale->contract->cofinavit_contract !== null) &&
                      $sale->contract->cofinavit_contract->CC_type == 'Individual')
                     ? 'selected'
                     : '' }}>@lang('shared.individual')</option>
              <option
                value="Conyugal"
                {{ (old('CC_type') == 'Conyugal')
                  ? 'selected'
                  : (($sale->contract !== null &&
                    $sale->contract->cofinavit_contract !== null) &&
                      $sale->contract->cofinavit_contract->CC_type == 'Conyugal')
                     ? 'selected'
                     : '' }}>@lang('shared.conyugal')</option>
            </select>

            @if ($errors->has('CC_type'))
              <span class="help-block">
                <strong>{{ $errors->first('CC_type') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div id="cofinavit_contract_conyugal" v-if="isCofinavitMarried">
          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_birth_certificate_of_the_spouse') ? ' has-error' : ''}}">
            <label
              for="CC_birth_certificate_of_the_spouse"
              class="checkbox-inline control-label">
              <input
                name="CC_birth_certificate_of_the_spouse"
                id="CC_birth_certificate_of_the_spouse"
                type="checkbox"
                v-model="contract.cofinavit.birth_certificate_of_the_spouse"
                @if (
                  !empty(old('CC_birth_certificate_of_the_spouse')) ||
                  (($sale->contract !== null &&
                    $sale->contract->cofinavit_contract !== null) &&
                    !empty($sale->contract->cofinavit_contract->CC_birth_certificate_of_the_spouse))
                )
                  checked
                @endif> @lang('sale.contract_cofinavit_birth_certificate_of_the_spouse')
            </label>

            @if ($errors->has('CC_birth_certificate_of_the_spouse'))
              <span class="help-block">
                <strong>{{ $errors->first('CC_birth_certificate_of_the_spouse') }}</strong>
              </span>
            @endif
          </div>

          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_official_identification_of_the_spouse') ? ' has-error' : ''}}">
            <label
              for="CC_official_identification_of_the_spouse"
              class="checkbox-inline control-label">
              <input
                name="CC_official_identification_of_the_spouse"
                id="CC_official_identification_of_the_spouse"
                type="checkbox"
                v-model="contract.cofinavit.official_identification_of_the_spouse"
                @if (
                  !empty(old('CC_official_identification_of_the_spouse')) ||
                  (($sale->contract !== null &&
                    $sale->contract->cofinavit_contract !== null) &&
                    !empty($sale->contract->cofinavit_contract->CC_official_identification_of_the_spouse))
                )
                  checked
                @endif> @lang('sale.contract_cofinavit_official_identification_of_the_spouse')
            </label>

            @if ($errors->has('CC_official_identification_of_the_spouse'))
              <span class="help-block">
                <strong>{{ $errors->first('CC_official_identification_of_the_spouse') }}</strong>
              </span>
            @endif
          </div>

          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_marriage_certificate') ? ' has-error' : ''}}">
            <label
              for="CC_marriage_certificate"
              class="checkbox-inline control-label">
              <input
                name="CC_marriage_certificate"
                id="CC_marriage_certificate"
                type="checkbox"
                v-model="contract.cofinavit.marriage_certificate"
                @if (
                  !empty(old('CC_marriage_certificate')) ||
                  (($sale->contract !== null &&
                    $sale->contract->cofinavit_contract !== null) &&
                    !empty($sale->contract->cofinavit_contract->CC_marriage_certificate))
                )
                  checked
                @endif> @lang('sale.contract_cofinavit_marriage_certificate')
            </label>

            @if ($errors->has('CC_marriage_certificate'))
              <span class="help-block">
                <strong>{{ $errors->first('CC_marriage_certificate') }}</strong>
              </span>
            @endif
          </div>
        </div>
      </div>

      <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix banking_contract" v-if="isBanking">
        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_contract_with_the_broker') ? ' has-error' : ''}}">
          <label
            for="SC_contract_with_the_broker"
            class="checkbox-inline control-label">
            <input
              name="SC_contract_with_the_broker"
              id="SC_contract_with_the_broker"
              type="checkbox"
              v-model="contract.banking.contract_with_the_broker"
              @if (
                !empty(old('SC_contract_with_the_broker')) ||
                ($sale->contract !== null &&
                 !empty($sale->contract->SC_contract_with_the_broker))
              )
                checked
              @endif> @lang('sale.contract_banking_contract_with_the_broker')
          </label>

          @if ($errors->has('SC_contract_with_the_broker'))
            <span class="help-block">
              <strong>{{ $errors->first('SC_contract_with_the_broker') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix allies_contract" v-if="isAllies">
        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_mortgage_broker') ? ' has-error' : ''}}">
          <label
            for="SC_mortgage_broker"
            class="checkbox-inline control-label">
            <input
              name="SC_mortgage_broker"
              id="SC_mortgage_broker"
              type="checkbox"
              v-model="contract.allies.mortgage_broker"
              @if (
                !empty(old('SC_mortgage_broker')) ||
                ($sale->contract !== null &&
                 !empty($sale->contract->SC_mortgage_broker))
              )
                checked
              @endif> @lang('sale.contract_allies_mortgage_broker')
          </label>

          @if ($errors->has('SC_mortgage_broker'))
            <span class="help-block">
              <strong>{{ $errors->first('SC_mortgage_broker') }}</strong>
            </span>
          @endif
        </div>
      </div>
    </fieldset>
  </div>
</div>
