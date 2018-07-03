@can('calls.delete', $call)
  <form class="form-inline" action="{{ route('call.destroy', ['id' => $call->id]) }}" method="post" class="text-center">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="form-group">
      <button
      type="submit"
      class="btn btn-danger"
      title="@lang('shared.remove') @lang('call.call')"
      data-toggle="tooltip"
      data-placement="bottom">
      <i class="glyphicon glyphicon-erase"></i>
    </button>
    </div>
  </form>
@endcan
