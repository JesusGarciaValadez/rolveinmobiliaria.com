@can('messages.delete', $message)
  <form class="form-inline" action="{{ route('message.destroy', ['id' => $message->id]) }}" method="post" class="text-center">
    @csrf
    @method('DELETE')

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
