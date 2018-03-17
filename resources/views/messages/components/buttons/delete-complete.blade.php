<form class="col-xs-12 col-sm-12 col-md-2 col-lg-2 form-inline text-center" action="{{ route('destroy_message', [
  'id' => $message->id
]) }}" method="post" class="text-center">
  @csrf
  @method('DELETE')

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
