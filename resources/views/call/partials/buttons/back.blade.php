<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 text-center">
  <a href="{{ isset($back) ? $back : url()->previous() }}" title="@lang('shared.go_back')" role="button" class="btn btn-default">
    <span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>
    @lang('shared.go_back')
  </a>
</div>
