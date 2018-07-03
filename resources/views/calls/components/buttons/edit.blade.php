<div class="form-group">
  <a
    class="btn btn-warning"
    href="{{ route('call_tracking.edit', ['id' => $call->id]) }}"
    role="button"
    title="@lang('shared.edit') @lang('call.call')"
    data-toggle="tooltip"
    data-placement="bottom">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
  </a>
</div>
