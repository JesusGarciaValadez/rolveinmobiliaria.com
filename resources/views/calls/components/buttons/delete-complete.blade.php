@can('call.delete', $call)
  <form class="col-xs-12 col-sm-12 col-md-2 col-lg-2 form-inline text-center" action="{{ route('call.destroy', ['call' => $call->id]) }}" method="post" class="text-center">
    @method('DELETE')
    @csrf
    <div class="form-group">
      <button
      type="submit"
      class="btn btn-danger"
      title="@lang('shared.remove') @lang('call.call')"
      data-toggle="tooltip"
      data-placement="bottom">
      <i class="glyphicon glyphicon-erase"></i> @lang('shared.remove') @lang('call.call')
    </button>
    </div>
  </form>
@endcan
