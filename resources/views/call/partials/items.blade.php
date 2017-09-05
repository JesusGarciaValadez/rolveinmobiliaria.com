<tr>
  <td>{{ $call->id }}</td>
  <td>{{ $call->type_of_operation }}</td>
  <td>{{ $call->client_phone_1 }}</td>
  <td>{{ $call->client_phone_2 }}</td>
  <td>{{ $call->email }}</td>
  <td>{{ $call->user->name }}</td>
  <td class="hidden-xs hidden-sm">{{ $call->observations }}</td>
  <td>{{ $call->address }}</td>
  <td>{{ $call->state['name'] }}</td>
  <td>{{ $call->hour }}</td>
  <td>
    <a href="#" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
</button></a>
  </td>
</tr>
