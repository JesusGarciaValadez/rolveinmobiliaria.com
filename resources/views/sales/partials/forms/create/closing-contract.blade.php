<div class="panel panel-default" v-if="showClosingContract" v-cloak>
  <div class="panel-heading" role="tab" id="closingContract">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        @lang('sale.closing_contract')
      </a>
    </h4>
  </div>
  <div id="collapseTwo" class="panel-collapse collapse-in collapse in" role="tabpanel" aria-labelledby="closingContract">
    <div class="panel-body">
      <fieldset>
        <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SCC_commercial_valuation') ? ' has-error' : ''}}">
          <label
            for="SCC_commercial_valuation"
            class="checkbox-inline control-label">
            <input
              name="SCC_commercial_valuation"
              id="SCC_commercial_valuation"
              type="checkbox"
              v-model="closingContract.commercial_valuation"
              @if (!empty(old('SCC_commercial_valuation')))
                checked
              @endif> @lang('sale.closing_contracts_commercial_valuation')
          </label>

          @if ($errors->has('SCC_commercial_valuation'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_commercial_valuation') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SCC_exclusivity_contract') ? ' has-error' : ''}}">
          <label
            for="SCC_exclusivity_contract"
            class="checkbox-inline control-label">
            <input
              name="SCC_exclusivity_contract"
              id="SCC_exclusivity_contract"
              type="checkbox"
              v-model="closingContract.exclusivity_contract"
              @if (!empty(old('SCC_exclusivity_contract')))
                checked
              @endif> @lang('sale.closing_contracts_exclusivity_contract')
          </label>

          @if ($errors->has('SCC_exclusivity_contract'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_exclusivity_contract') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-0 form-group{{ $errors->has('SCC_publication') ? ' has-error' : ''}}">
          <label
            for="SCC_publication"
            class="checkbox-inline control-label">
            <input
              name="SCC_publication"
              id="SCC_publication"
              type="checkbox"
              v-model="closingContract.publication"
              @if (!empty(old('SCC_publication')))
                checked
              @endif> @lang('sale.closing_contracts_publication')
          </label>

          @if ($errors->has('SCC_publication'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_publication') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('SCC_data_sheet') ? ' has-error' : ''}} clearfix">
          <label
            for="SCC_data_sheet"
            class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">@lang('sale.closing_contracts_data_sheet')</label>

          <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <input
              name="SCC_data_sheet"
              id="SCC_data_sheet"
              type="file"
              class="form-control"
              value="{{ old('SCC_data_sheet') }}"
              placeholder="@lang('sale.closing_contracts_data_sheet')"
              autocorrect="on"
              accept=".pdf, .doc, .docx"
              @change="onUpload">

            @if ($errors->has('SCC_data_sheet'))
              <span class="help-block">
                <strong>{{ $errors->first('SCC_data_sheet') }}</strong>
              </span>
            @endif
          </p>
        </div>

        <div class="form-group{{ $errors->has('SCC_closing_contract_observations') ? ' has-error' : ''}} clearfix">
          <label
            for="SCC_closing_contract_observations"
            class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">@lang('shared.observations'):</label>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <textarea
              class="form-control"
              name="SCC_closing_contract_observations"
              id="SCC_closing_contract_observations"
              placeholder="@lang('shared.observations')"
              autocorrect="on"
              v-model="closingContract.observations">{{ old('SCC_closing_contract_observations') }}</textarea>

            @if ($errors->has('SCC_closing_contract_observations'))
              <span class="help-block">
                <strong>{{ $errors->first('SCC_closing_contract_observations') }}</strong>
              </span>
            @endif
          </div>
        </div>
      </fieldset>
    </div>
  </div>
</div>
