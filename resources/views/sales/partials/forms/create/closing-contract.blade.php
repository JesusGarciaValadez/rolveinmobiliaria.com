<div class="panel panel-default" v-show="showClosingContract">
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
        <div class="col-xs-12 form-group{{ $errors->has('SCC_exclusivity_contract') ? ' has-error' : ''}}">
          <label
            for="SCC_exclusivity_contract"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-3">
            @lang('sale.closing_contracts_exclusivity_contract'):
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-9">
            <input
              name="SCC_exclusivity_contract"
              id="SCC_exclusivity_contract"
              class="form-control"
              type="date"
              placeholder="mm-dd-aaaa"
              value="{{ old('SCC_exclusivity_contract') }}"
              min="01-01-2017" max="12-31-2099"
              pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
              v-model="sale.closing_contracts_exclusivity_contract">
          </div>

          @if ($errors->has('SCC_exclusivity_contract'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_exclusivity_contract') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('SCC_commercial_valuation') ? ' has-error' : ''}}">
          <label
            for="SCC_commercial_valuation"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-3">
            @lang('sale.closing_contracts_commercial_valuation'):
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-9">
            <input
              name="SCC_commercial_valuation"
              id="SCC_commercial_valuation"
              class="form-control"
              type="date"
              placeholder="mm-dd-aaaa"
              value="{{ old('SCC_commercial_valuation') }}"
              min="01-01-2017" max="12-31-2099"
              pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
              v-model="sale.closingContract.commercial_valuation">
          </div>

          @if ($errors->has('SCC_commercial_valuation'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_commercial_valuation') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('SCC_publication') ? ' has-error' : ''}}">
          <label
            for="SCC_publication"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-3">
            @lang('sale.closing_contracts_publication'):
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-9">
            <input
              name="SCC_publication"
              id="SCC_publication"
              class="form-control"
              type="date"
              placeholder="mm-dd-aaaa"
              value="{{ old('SCC_publication') }}"
              min="01-01-2017" max="12-31-2099"
              pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
              v-model="sale.closingContract.publication">
          </div>

          @if ($errors->has('SCC_publication'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_publication') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('SCC_data_sheet') ? ' has-error' : ''}}">
          <label
            for="SCC_data_sheet"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-3">
            @lang('sale.closing_contracts_data_sheet'):
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-9">
            <input
              name="SCC_data_sheet"
              id="SCC_data_sheet"
              type="file"
              class="form-control"
              placeholder="mm-dd-aaaa"
              value="{{ old('SCC_data_sheet') }}"
              placeholder="@lang('sale.closing_contracts_data_sheet')"
              autocorrect="on"
              accept=".pdf, .doc, .docx"
              @change="onUpload">
          </div>

          @if ($errors->has('SCC_data_sheet'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_data_sheet') }}</strong>
            </span>
          @endif
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('SCC_closing_contract_observations') ? ' has-error' : ''}}">
          <label
            for="SCC_closing_contract_observations"
            class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-3">
            @lang('shared.observations'):
          </label>
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-9">
            <textarea
              class="form-control"
              name="SCC_closing_contract_observations"
              id="SCC_closing_contract_observations"
              placeholder="@lang('shared.observations')"
              autocorrect="on"
              v-model="sale.closingContract.observations">{{ old('SCC_closing_contract_observations') }}</textarea>
          </div>

          @if ($errors->has('SCC_closing_contract_observations'))
            <span class="help-block">
              <strong>{{ $errors->first('SCC_closing_contract_observations') }}</strong>
            </span>
          @endif
        </div>
      </fieldset>
    </div>
  </div>
</div>
