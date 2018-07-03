<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 form-group text-center">
  <a
    class="btn btn-warning"
    href="{{ route('message.edit', ['id' => $message->id]) }}"
    role="button"
    title="@lang('shared.edit') @lang('call.call')"
    data-toggle="tooltip"
    data-placement="bottom">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> @lang('shared.edit') @lang('call.call')
  </a>
</div>
