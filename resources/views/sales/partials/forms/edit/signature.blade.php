<div class="panel panel-default" v-if="showSignature">
  <div class="panel-heading" role="tab" id="signature">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
        @lang('sale.signature')
      </a>
    </h4>
  </div>
  <div id="collapseSix" class="panel-collapse collapse-in collapse in" role="tabpanel" aria-labelledby="signature">
    <div class="panel-body">
      <fieldset>
        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-6 col-lg-offset-0 form-group{{ $errors->has('SS_writing_review') ? ' has-error' : ''}}">
          <label
            for="SS_writing_review"
            class="checkbox-inline control-label">
            <input
              name="SS_writing_review"
              type="checkbox"
              required
              v-model="signature.writing_review.default"
              @if (
                !empty(old($sale->document->SS_writing_review)) ||
                !empty($sale->document->SS_writing_review)
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
              type="checkbox"
              required
              v-model="signature.scheduled_date_of_writing_signature.default"
              @if (
                !empty(old($sale->document->SS_scheduled_date_of_writing_signature)) ||
                !empty($sale->document->SS_scheduled_date_of_writing_signature)
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
              type="checkbox"
              required
              v-model="signature.writing_signature.default"
              @if (
                !empty(old($sale->document->SS_writing_signature)) ||
                !empty($sale->document->SS_writing_signature)
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
              type="checkbox"
              required
              v-model="signature.scheduled_payment_date.default"
              @if (
                !empty(old($sale->document->SS_scheduled_payment_date)) ||
                !empty($sale->document->SS_scheduled_payment_date)
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
              type="checkbox"
              required
              v-model="signature.payment_made.default"
              @if (
                !empty(old($sale->document->SS_payment_made)) ||
                !empty($sale->document->SS_payment_made)
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
</div>
