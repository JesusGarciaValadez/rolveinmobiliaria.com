<div class="form-group">
  <a
    class="btn btn-warning"
    href="{{ route('edit_message', ['id' => $message->id]) }}"
    role="button"
    title="@lang('shared.edit') @lang('message.message')"
    data-toggle="tooltip"
    data-placement="bottom">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
  </a>
</div>
