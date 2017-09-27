@can('calls.delete', App\Call::class)
  <form class="form-inline" action="{{ route('destroy_call', ['id' => $call->id]) }}" method="post" class="text-center">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="form-group">
      <button
      type="submit"
      class="btn btn-danger"
      title="Eliminar llamada"
      data-toggle="tooltip"
      data-placement="bottom">
      <i class="glyphicon glyphicon-erase"></i>
    </button>
    </div>
  </form>
@endcan
