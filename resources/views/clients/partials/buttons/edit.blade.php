<div class="form-group">
  <a
    class="btn btn-warning"
    href="{{ route('edit_client', ['id' => $client->id]) }}"
    role="button"
    title="@lang('shared.edit') @lang('client.client')"
    data-toggle="tooltip"
    data-placement="bottom">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
  </a>
</div>
