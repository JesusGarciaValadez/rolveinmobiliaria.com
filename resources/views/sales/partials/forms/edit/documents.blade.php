<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="documents">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Documentos
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse-in" role="tabpanel" aria-labelledby="documents">
    <div class="panel-body">
      <form
        class="form-horizontal"
        action="{{ route('update_sale_documents', [
          'id' => request('id')
        ]) }}"
        method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="user_id" value="{{ $sale->user->id }}">

        <input type="hidden" name="complete" value="{{ $sale->document->complete }}">

        <div class="form-group{{ $errors->has('predial') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="predial"
              class="checkbox control-label">
              <input
                name="predial"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->predial)) ||
                  !empty($sale->document->predial)
                  )
                  checked
                @endif
                required> @lang('sale.documents_predial')
            </label>

            @if ($errors->has('predial'))
              <span class="help-block">
                <strong>{{ $errors->first('predial') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('light') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="predial"
              class="checkbox control-label">
              <input
                name="light"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->light)) ||
                  !empty($sale->document->light)
                  )
                  checked
                @endif
                required> @lang('sale.documents_light')
            </label>

            @if ($errors->has('light'))
              <span class="help-block">
                <strong>{{ $errors->first('light') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('water') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="water"
              class="checkbox control-label">
              <input
                name="water"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->water)) ||
                  !empty($sale->document->water)
                  )
                  checked
                @endif
                required> @lang('sale.documents_water')
                {{ $sale->document->water }}
            </label>

            @if ($errors->has('water'))
              <span class="help-block">
                <strong>{{ $errors->first('water') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('deed') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="deed"
              class="checkbox control-label">
              <input
                name="deed"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->deed)) ||
                  !empty($sale->document->deed)
                  )
                  checked
                @endif
                required> @lang('sale.documents_deed')
            </label>

            @if ($errors->has('deed'))
              <span class="help-block">
                <strong>{{ $errors->first('deed') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('general_sheet') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="general_sheet"
              class="checkbox control-label">
              <input
                name="general_sheet"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->general_sheet)) ||
                  !empty($sale->document->general_sheet)
                  )
                  checked
                @endif> @lang('sale.documents_general_sheet')
            </label>

            @if ($errors->has('general_sheet'))
              <span class="help-block">
                <strong>{{ $errors->first('general_sheet') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('INE') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="INE"
              class="checkbox control-label">
              <input
                name="INE"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->INE)) ||
                  !empty($sale->document->INE)
                  )
                  checked
                @endif> @lang('sale.documents_ine')
            </label>

            @if ($errors->has('INE'))
              <span class="help-block">
                <strong>{{ $errors->first('INE') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('CURP') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="CURP"
              class="checkbox control-label">
              <input
                name="CURP"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->CURP)) ||
                  !empty($sale->document->CURP)
                  )
                  checked
                @endif> @lang('sale.documents_curp')
            </label>

            @if ($errors->has('CURP'))
              <span class="help-block">
                <strong>{{ $errors->first('CURP') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('civil_status') ? ' has-error' : ''}}">
          <label
            for="civil_status"
            class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3 control-label">@lang('sale.documents_civil_status'):
          </label>
          <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
            <select
              class="form-control"
              id="civil_status"
              name="civil_status"
              autofocus
              required>
              <option
                value=""
                {{ (!old('civil_status')) ? 'selected' : '' }}>@lang('shared.choose_an_option')</option>
              <option
                value="Soltero"
                {{ (old('civil_status') == 'Soltero'
                || $sale->document->civil_status == 'Soltero')
                    ? 'selected'
                    : '' }}>@lang('sale.documents_single')</option>
              <option
                value="Casado"
                {{ (old('civil_status') == 'Casado'
                || $sale->document->civil_status == 'Casado')
                    ? 'selected'
                    : '' }}>@lang('sale.documents_married')</option>
            </select>

            @if ($errors->has('civil_status'))
              <span class="help-block">
                <strong>{{ $errors->first('civil_status') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('birth_certificate') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="birth_certificate"
              class="checkbox control-label">
              <input
                name="birth_certificate"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->birth_certificate)) ||
                  !empty($sale->document->birth_certificate)
                  )
                  checked
                @endif> @lang('sale.documents_birth_certificate')
            </label>

            @if ($errors->has('birth_certificate'))
              <span class="help-block">
                <strong>{{ $errors->first('birth_certificate') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('account_status') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="account_status"
              class="checkbox control-label">
              <input
                name="account_status"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->account_status)) ||
                  !empty($sale->document->account_status)
                  )
                  checked
                @endif> @lang('sale.documents_account_status')
            </label>

            @if ($errors->has('account_status'))
              <span class="help-block">
                <strong>{{ $errors->first('account_status') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="email"
              class="checkbox control-label">
              <input
                name="email"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->email)) ||
                  !empty($sale->document->email)
                  )
                  checked
                @endif> @lang('sale.email')
            </label>

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('phone') ? ' has-error' : ''}}">
          <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
            <label
              for="phone"
              class="checkbox control-label">
              <input
                name="phone"
                type="checkbox"
                value="1"
                @if (
                  !empty(old($sale->document->phone)) ||
                  !empty($sale->document->phone)
                  )
                  checked
                @endif> @lang('sale.documents_phone')
            </label>

            @if ($errors->has('phone'))
              <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
              </span>
            @endif
          </div>
        </div>

        @include('sales.partials.buttons.save')
      </form>
    </div>
  </div>
</div>
