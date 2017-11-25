<div class="panel panel-default" v-if="showPurchaseAgreement">
  <div class="panel-heading" role="tab" id="purchaseAgreement">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
        @lang('sale.purchase_agreement')
      </a>
    </h4>
  </div>
  <div id="collapseFour" class="panel-collapse collapse-in collapse in" role="tabpanel" aria-labelledby="purchaseAgreement">
    <div class="panel-body">
      <fieldset>
        <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_general_buyer') ? ' has-error' : ''}}">
          <label
            for="SC_general_buyer"
            class="checkbox-inline control-label">
            <input
              name="SC_general_buyer"
              type="checkbox"
              required
              v-model="purchaseAgreement.general_buyer.default"
              @if (
                !empty(old($sale->document->SC_general_buyer)) ||
                !empty($sale->document->SC_general_buyer)
                )
                checked
              @endif> @lang('sale.purchase_agreement_general_buyer')
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
              type="checkbox"
              required
              v-model="purchaseAgreement.purchase_agreements.default"
              @if (
                !empty(old($sale->document->SC_purchase_agreements)) ||
                !empty($sale->document->SC_purchase_agreements)
                )
                checked
              @endif> @lang('sale.purchase_agreement_purchase_agreements')
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
              type="checkbox"
              required
              v-model="purchaseAgreement.tax_assessment.default"
              @if (
                !empty(old($sale->document->SC_tax_assessment)) ||
                !empty($sale->document->SC_tax_assessment)
                )
                checked
              @endif> @lang('sale.purchase_agreement_tax_assessment')
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
              type="checkbox"
              required
              v-model="purchaseAgreement.notary_checklist.default"
              @if (
                !empty(old($sale->document->SC_notary_checklist)) ||
                !empty($sale->document->SC_notary_checklist)
                )
                checked
              @endif> @lang('sale.purchase_agreement_notary_checklist')
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
              type="checkbox"
              required
              v-model="purchaseAgreement.notary_file.default"
              @if (
                !empty(old($sale->document->SC_notary_file)) ||
                !empty($sale->document->SC_notary_file)
                )
                checked
              @endif> @lang('sale.purchase_agreement_notary_file')
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
            class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('sale.purchase_agreement_contract_mortgage_credit'): </label>
          <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
            <select
              class="form-control"
              id="SC_mortgage_credit"
              name="SC_mortgage_credit"
              required
              autofocus
              v-model="purchaseAgreement.mortgage_credit.default">
              <option
                value=""
                disabled
                {{ (!old('SC_mortgage_credit'))
                  ? 'selected'
                  : '' }}>@lang('shared.choose_an_option')</option>
              <option
                value="INFONAVIT"
                {{ (old('SC_mortgage_credit') === 'INFONAVIT')
                  ? 'selected'
                  : '' }}>@lang('sale.purchase_agreement_infonavit')</option>
              <option
                value="FOVISSSTE"
                {{ (old('SC_mortgage_credit') === 'FOVISSSTE')
                  ? 'selected'
                  : '' }}>@lang('sale.purchase_agreement_fovissste')</option>
              <option
                value="COFINAVIT"
                {{ (old('SC_mortgage_credit') == 'COFINAVIT')
                  ? 'selected'
                  : '' }}>@lang('sale.purchase_agreement_cofinavit')</option>
              <option
                value="Bancario"
                {{ (old('SC_mortgage_credit') == 'Bancario')
                  ? 'selected'
                  : '' }}>@lang('shared.banking')</option>
              <option
                value="Aliados"
                {{ (old('SC_mortgage_credit') == 'Aliados')
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

        <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix infonavit_contract" v-if="isINFONAVIT">
          <legend class="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix">INFONAVIT</legend>

          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_certified_birth_certificate') ? ' has-error' : ''}}">
            <label
              for="IC_certified_birth_certificate"
              class="checkbox-inline control-label">
              <input
                name="IC_certified_birth_certificate"
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.certified_birth_certificate.default"
                @if (
                  !empty(old($sale->document->IC_certified_birth_certificate)) ||
                  !empty($sale->document->IC_certified_birth_certificate)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.official_ID.default"
                @if (
                  !empty(old($sale->document->IC_official_ID)) ||
                  !empty($sale->document->IC_official_ID)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.curp.default"
                @if (
                  !empty(old($sale->document->IC_curp)) ||
                  !empty($sale->document->IC_curp)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.rfc.default"
                @if (
                  !empty(old($sale->document->IC_rfc)) ||
                  !empty($sale->document->IC_rfc)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.credit_simulator.default"
                @if (
                  !empty(old($sale->document->IC_credit_simulator)) ||
                  !empty($sale->document->IC_credit_simulator)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_credit_simulator')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.credit_application.default"
                @if (
                  !empty(old($sale->document->IC_credit_application)) ||
                  !empty($sale->document->IC_credit_application)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_credit_application')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.tax_valuation.default"
                @if (
                  !empty(old($sale->document->IC_tax_valuation)) ||
                  !empty($sale->document->IC_tax_valuation)
                )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_tax_valuation')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.bank_statement.default"
                @if (
                  !empty(old($sale->document->IC_bank_statement)) ||
                  !empty($sale->document->IC_bank_statement)
                )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_bank_statement')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.workshop_knowing_how_to_decide.default"
                @if (
                  !empty(old($sale->document->IC_workshop_knowing_how_to_decide)) ||
                  !empty($sale->document->IC_workshop_knowing_how_to_decide)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_workshop_knowing_how_to_decide')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.retention_sheet.default"
                @if (
                  !empty(old($sale->document->IC_retention_sheet)) ||
                  !empty($sale->document->IC_retention_sheet)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_retention_sheet')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.credit_activation.default"
                @if (
                  !empty(old($sale->document->IC_credit_activation)) ||
                  !empty($sale->document->IC_credit_activation)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_credit_activation')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.infonavit.credit_maturity.default"
                @if (
                  !empty(old($sale->document->IC_credit_maturity)) ||
                  !empty($sale->document->IC_credit_maturity)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_infonavit_credit_maturity')
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
                id="IC_type"
                name="IC_type"
                required
                v-model="purchaseAgreement.infonavit.type.default">
                <option
                  value=""
                  disabled
                  {{ (!old('IC_type')) ? 'selected' : '' }}>@lang('shared.choose_an_option')</option>
                <option
                  value="Individual"
                  {{ (old('IC_type') == 'Individual')
                    ? 'selected'
                    : '' }}>@lang('shared.individual')</option>
                <option
                  value="Conyugal"
                  {{ (old('IC_type') == 'Conyugal')
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

          <div id="infonavit_contract_conyugal" v-if="isINFONAVITMarried">
            <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('IC_spouses_birth_certificate') ? ' has-error' : ''}}">
              <label
                for="IC_spouses_birth_certificate"
                class="checkbox-inline control-label">
                <input
                  name="IC_spouses_birth_certificate"
                  type="checkbox"
                  required
                  v-model="purchaseAgreement.infonavit.spouses_birth_certificate.default"
                  @if (
                    !empty(old($sale->document->IC_spouses_birth_certificate)) ||
                    !empty($sale->document->IC_spouses_birth_certificate)
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
                  type="checkbox"
                  required
                  v-model="purchaseAgreement.infonavit.official_identification_of_the_spouse.default"
                  @if (
                    !empty(old($sale->document->IC_official_identification_of_the_spouse)) ||
                    !empty($sale->document->IC_official_identification_of_the_spouse)
                    )
                    checked
                  @endif> @lang('sale.purchase_agreement_infonavit_official_identification_of_the_spouse')
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
                  type="checkbox"
                  required
                  v-model="purchaseAgreement.infonavit.marriage_certificate.default"
                  @if (
                    !empty(old($sale->document->IC_marriage_certificate)) ||
                    !empty($sale->document->IC_marriage_certificate)
                    )
                    checked
                  @endif> @lang('sale.purchase_agreement_infonavit_marriage_certificate')
              </label>

              @if ($errors->has('IC_marriage_certificate'))
                <span class="help-block">
                  <strong>{{ $errors->first('IC_marriage_certificate') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>

        <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix fovissste_contract" v-if="isFOVISSSTE">
          <legend class="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix">FOVISSSTE</legend>
          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('FC_credit_simulator') ? ' has-error' : ''}}">
            <label
              for="FC_credit_simulator"
              class="checkbox-inline control-label">
              <input
                name="FC_credit_simulator"
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.credit_simulator.defadefault"
                @if (
                  !empty(old($sale->document->FC_credit_simulator)) ||
                  !empty($sale->document->FC_credit_simulator)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_fovissste_credit_simulator')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.curp.default"
                @if (
                  !empty(old($sale->document->FC_curp)) ||
                  !empty($sale->document->FC_curp)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.birth_certificate.defdefault"
                @if (
                  !empty(old($sale->document->FC_birth_certificate)) ||
                  !empty($sale->document->FC_birth_certificate)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.bank_statement.default"
                @if (
                  !empty(old($sale->document->FC_bank_statement)) ||
                  !empty($sale->document->FC_bank_statement)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_fovissste_bank_statement')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.single_key_housing_payment.default"
                @if (
                  !empty(old($sale->document->FC_single_key_housing_payment)) ||
                  !empty($sale->document->FC_single_key_housing_payment)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_fovissste_single_key_housing_payment')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.general_buyers_and_sellers.default"
                @if (
                  !empty(old($sale->document->FC_general_buyers_and_sellers)) ||
                  !empty($sale->document->FC_general_buyers_and_sellers)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_fovissste_general_buyers_and_sellers')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.education_course.default"
                @if (
                  !empty(old($sale->document->FC_education_course)) ||
                  !empty($sale->document->FC_education_course)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_fovissste_education_course')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.last_pay_stub.default"
                @if (
                  !empty(old($sale->document->FC_last_pay_stub)) ||
                  !empty($sale->document->FC_last_pay_stub)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_fovissste_last_pay_stub')
            </label>

            @if ($errors->has('FC_last_pay_stub'))
              <span class="help-block">
                <strong>{{ $errors->first('FC_last_pay_stub') }}</strong>
              </span>
            @endif
          </div>

          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SC_notary_file') ? ' has-error' : ''}}">
            <label
              for="SC_notary_file"
              class="checkbox-inline control-label">
              <input
                name="SC_notary_file"
                type="checkbox"
                required
                v-model="purchaseAgreement.fovissste.notary_file.default"
                @if (
                  !empty(old($sale->document->SC_notary_file)) ||
                  !empty($sale->document->SC_notary_file)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_notary_file')
            </label>

            @if ($errors->has('SC_notary_file'))
              <span class="help-block">
                <strong>{{ $errors->first('SC_notary_file') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div id="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix cofinavit_contract" v-if="isCOFINAVIT">
          <legend class="col-xs-12 col-sm-12 col-md-12 col-lg-12 block clearfix">COFINAVIT</legend>

          <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_request_for_credit_inspection') ? ' has-error' : ''}}">
            <label
              for="CC_request_for_credit_inspection"
              class="checkbox-inline control-label">
              <input
                name="CC_request_for_credit_inspection"
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.request_for_credit_inspection.default"
                @if (
                  !empty(old($sale->document->CC_request_for_credit_inspection)) ||
                  !empty($sale->document->CC_request_for_credit_inspection)
                )
                  checked
                @endif> @lang('sale.purchase_agreement_cofinavit_request_for_credit_inspection')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.birth_certificate.defdefault"
                @if (
                  !empty(old($sale->document->CC_birth_certificate)) ||
                  !empty($sale->document->CC_birth_certificate)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.official_id.default"
                @if (
                  !empty(old($sale->document->CC_official_id)) ||
                  !empty($sale->document->CC_official_id)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.curp.default"
                @if (
                  !empty(old($sale->document->CC_curp)) ||
                  !empty($sale->document->CC_curp)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.rfc.default"
                @if (
                  !empty(old($sale->document->CC_rfc)) ||
                  !empty($sale->document->CC_rfc)
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
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.bank_statement_seller.default"
                @if (
                  !empty(old($sale->document->CC_bank_statement_seller)) ||
                  !empty($sale->document->CC_bank_statement_seller)
                )
                  checked
                @endif> @lang('sale.purchase_agreement_cofinavit_bank_statement_seller')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.tax_valuation.default"
                @if (
                  !empty(old($sale->document->CC_tax_valuation)) ||
                  !empty($sale->document->CC_tax_valuation)
                )
                  checked
                @endif> @lang('sale.purchase_agreement_cofinavit_tax_valuation')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.cofinavit.scripture_copy.default"
                @if (
                  !empty(old($sale->document->CC_scripture_copy)) ||
                  !empty($sale->document->CC_scripture_copy)
                )
                  checked
                @endif> @lang('sale.purchase_agreement_cofinavit_scripture_copy')
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
                id="CC_type"
                name="CC_type"
                required
                v-model="purchaseAgreement.cofinavit.type.default">
                <option
                  value=""
                  disabled
                  {{ (!old('CC_type')) ? 'selected' : '' }}>@lang('shared.choose_an_option')</option>
                <option
                  value="Individual"
                  {{ (old('CC_type') == 'Individual')
                    ? 'selected'
                    : '' }}>@lang('shared.individual')</option>
                <option
                  value="Conyugal"
                  {{ (old('CC_type') == 'Conyugal')
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

          <div id="cofinavit_contract_conyugal" v-if="isCOFINAVITMarried">
            <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('CC_birth_certificate_of_the_spouse') ? ' has-error' : ''}}">
              <label
                for="CC_birth_certificate_of_the_spouse"
                class="checkbox-inline control-label">
                <input
                  name="CC_birth_certificate_of_the_spouse"
                  type="checkbox"
                  required
                  v-model="purchaseAgreement.cofinavit.birth_certificate_of_the_spouse.default"
                  @if (
                    !empty(old($sale->document->CC_birth_certificate_of_the_spouse)) ||
                    !empty($sale->document->CC_birth_certificate_of_the_spouse)
                  )
                    checked
                  @endif> @lang('sale.purchase_agreement_cofinavit_birth_certificate_of_the_spouse')
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
                  type="checkbox"
                  required
                  v-model="purchaseAgreement.cofinavit.official_identification_of_the_spouse.default"
                  @if (
                    !empty(old($sale->document->CC_official_identification_of_the_spouse)) ||
                    !empty($sale->document->CC_official_identification_of_the_spouse)
                  )
                    checked
                  @endif> @lang('sale.purchase_agreement_cofinavit_official_identification_of_the_spouse')
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
                  type="checkbox"
                  required
                  v-model="purchaseAgreement.cofinavit.marriage_certificate.default"
                  @if (
                    !empty(old($sale->document->CC_marriage_certificate)) ||
                    !empty($sale->document->CC_marriage_certificate)
                  )
                    checked
                  @endif> @lang('sale.purchase_agreement_cofinavit_marriage_certificate')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.banking.contract_with_the_broker.default"
                @if (
                  !empty(old($sale->document->SC_contract_with_the_broker)) ||
                  !empty($sale->document->SC_contract_with_the_broker)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_banking_contract_with_the_broker')
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
                type="checkbox"
                required
                v-model="purchaseAgreement.allies.mortgage_broker.default"
                @if (
                  !empty(old($sale->document->SC_mortgage_broker)) ||
                  !empty($sale->document->SC_mortgage_broker)
                  )
                  checked
                @endif> @lang('sale.purchase_agreement_allies_mortgage_broker')
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
</div>
