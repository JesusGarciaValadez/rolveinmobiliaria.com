<tr>
  <td>
    <a href="{{ route('show_call', ['id' => $call->id]) }}">{{ $call->id }}</a>
  </td>
  <td>{{ $call->expedient }}</td>
  <td>{{ $call->type_of_operation }}</td>
  <td>{{ $call->client }}</td>
  <td>{{ $call->client_phone_1 }}</td>
  <td>{{ $call->client_phone_2 }}</td>
  <td>{{ $call->email }}</td>
  <td>{{ $call->user->name }}</td>
  <td class="hidden-xs hidden-sm">{{ $call->observations }}</td>
  <td>{{ $call->address }}</td>
  <td>{{ $call->state->name }}</td>
  <td>{{ (isset($call->updated)) ? $call->updated : $call->created }}</td>
  <td class="text-center"><span class="label
    @if ($call->status == 'Abierto')
      label-danger
    @else
      label-primary
    @endif">{{ $call->status }}</span></td>
  <td class="text-center"><span class="label
    @if ($call->priority == 'Baja')
      label-primary
    @elseif ($call->priority == 'Media')
      label-warning
    @else
      label-danger
    @endif">{{ $call->priority }}</span></td>
  <td class="text-center">
    @include('call.partials.buttons.edit')

    @include('call.partials.buttons.delete')
  </td>
</tr>
