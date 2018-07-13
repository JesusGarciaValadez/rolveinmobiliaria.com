@can('client.delete', $client)
  <form
    class="form-inline"
    action="{{ route('client.destroy', [
      'client' => $client->id
    ]) }}"
    method="post"
    class="text-center">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="form-group">
      <button
      type="submit"
      class="btn btn-danger"
      title="@lang('shared.remove') @lang('client.client')"
      data-toggle="tooltip"
      data-placement="bottom">
      <i class="glyphicon glyphicon-erase"></i>
    </button>
    </div>
  </form>
@endcan
