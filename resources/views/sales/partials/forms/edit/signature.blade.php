<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">@lang('sale.signature')</h4>
  </div>
  <div class="panel-body">
    <fieldset>
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-6 col-lg-offset-0 form-group{{ $errors->has('SS_writing_review') ? ' has-error' : ''}}">
        <label
          for="SS_writing_review"
          class="checkbox-inline control-label">
          <input
            name="SS_writing_review"
            id="SS_writing_review"
            type="checkbox"
            @if (
              !empty(old('SS_writing_review')) ||
              ($sale->signature !== null &&
               !empty($sale->signature->SS_writing_review))
            )
              checked
            @endif> @lang('sale.signature_writing_review')
        </label>

        @if ($errors->has('SS_writing_review'))
          <span class="help-block">
            <strong>{{ $errors->first('SS_writing_review') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-6 col-lg-offset-0 form-group{{ $errors->has('SS_scheduled_date_of_writing_signature') ? ' has-error' : ''}}">
        <label
          for="SS_scheduled_date_of_writing_signature"
          class="checkbox-inline control-label">
          <input
            name="SS_scheduled_date_of_writing_signature"
            id="SS_scheduled_date_of_writing_signature"
            type="checkbox"
            @if (
              !empty(old('SS_scheduled_date_of_writing_signature')) ||
              ($sale->signature !== null &&
               !empty($sale->signature->SS_scheduled_date_of_writing_signature))
            )
              checked
            @endif> @lang('sale.signature_scheduled_date_of_writing_signature')
        </label>

        @if ($errors->has('SS_scheduled_date_of_writing_signature'))
          <span class="help-block">
            <strong>{{ $errors->first('SS_scheduled_date_of_writing_signature') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-6 col-lg-offset-0 form-group{{$errors->has('SS_writing_signature') ? ' has-error' : ''}}">
        <label
          for="SS_writing_signature"
          class="checkbox-inline control-label">
          <input
            name="SS_writing_signature"
            id="SS_writing_signature"
            type="checkbox"
            @if (
              !empty(old('SS_writing_signature')) ||
              ($sale->signature !== null &&
               !empty($sale->signature->SS_writing_signature))
            )
              checked
            @endif> @lang('sale.signature_writing_signature')
        </label>

        @if ($errors->has('SS_writing_signature'))
          <span class="help-block">
            <strong>{{ $errors->first('SS_writing_signature') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-6 col-lg-offset-0 form-group{{ $errors->has('SS_scheduled_payment_date') ? ' has-error' : ''}}">
        <label
          for="SS_scheduled_payment_date"
          class="checkbox-inline control-label">
          <input
            name="SS_scheduled_payment_date"
            id="SS_scheduled_payment_date"
            type="checkbox"
            @if (
              !empty(old('SS_scheduled_payment_date')) ||
              ($sale->signature !== null &&
               !empty($sale->signature->SS_scheduled_payment_date))
            )
              checked
            @endif> @lang('sale.signature_scheduled_payment_date')
        </label>

        @if ($errors->has('SS_scheduled_payment_date'))
          <span class="help-block">
            <strong>{{ $errors->first('SS_scheduled_payment_date') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-6 col-lg-offset-0 form-group{{ $errors->has('SS_payment_made') ? ' has-error' : ''}}">
        <label
          for="SS_payment_made"
          class="checkbox-inline control-label">
          <input
            name="SS_payment_made"
            id="SS_payment_made"
            type="checkbox"
            @if (
              !empty(old('SS_payment_made')) ||
              ($sale->signature !== null && !empty($sale->signature->SS_payment_made))
            )
              checked
            @endif> @lang('sale.signature_payment_made')
        </label>

        @if ($errors->has('SS_payment_made'))
          <span class="help-block">
            <strong>{{ $errors->first('SS_payment_made') }}</strong>
          </span>
        @endif
      </div>
    </fieldset>
  </div>
</div>
