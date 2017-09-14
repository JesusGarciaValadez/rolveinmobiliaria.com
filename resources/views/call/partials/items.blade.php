<tr>
  <td>{{ $call->id }}</td>
  <td>{{ $call->type_of_operation }}</td>
  <td>{{ $call->client_phone_1 }}</td>
  <td>{{ $call->client_phone_2 }}</td>
  <td>{{ $call->email }}</td>
  <td>{{ $call->user->name }}</td>
  <td class="hidden-xs hidden-sm">{{ $call->observations }}</td>
  <td>{{ $call->address }}</td>
  <td>{{ $call->state->name }}</td>
  <td>{{ $call->hour }}</td>
  <td>
    <div class="form-group">
      <a class="btn btn-warning" href="{{ route('edit_call', ['id' => $call->id]) }}" title="Editar" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>
    </div>
    @can('calls.delete', App\Call::class)
    <form class="form-inline" action="{{ route('destroy_call', ['id' => $call->id]) }}" method="post">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <div class="form-group">
        <button type="submit" class="btn btn-danger">
          <i class="glyphicon glyphicon-trash"></i> Eliminar
        </button>
      </div>
    </form>
    @endcan
  </td>
</tr>
