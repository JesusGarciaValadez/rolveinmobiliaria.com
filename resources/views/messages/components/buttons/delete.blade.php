@can('message.delete', $message)
  <form class="form-inline" action="{{ route('message.destroy', [
    'message' => $message->id
  ]) }}" method="post" class="text-center">
    @method('DELETE')
    @csrf

    <div class="form-group">
      <button
      type="submit"
      class="btn btn-danger"
      title="@lang('shared.remove') @lang('message.message')"
      data-toggle="tooltip"
      data-placement="bottom">
      <i class="glyphicon glyphicon-erase"></i>
    </button>
    </div>
  </form>
@endcan
