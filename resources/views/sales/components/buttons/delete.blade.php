@can('sales.delete', $sale)
  <form
    class="form-inline"
    action="{{ route('for_sale.destroy', ['id' => $sale->id]) }}"
    method="post"
    class="text-center">
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
