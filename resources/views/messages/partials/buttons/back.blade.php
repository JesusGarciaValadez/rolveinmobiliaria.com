<div class="form-group clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
    <a
      href="{{ isset($back) ? $back : url()->previous() }}"
      title="@lang('shared.go_back')"
      role="button"
      class="btn btn-default">
      <span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>
      @lang('shared.go_back')
    </a>
  </div>
</div>
