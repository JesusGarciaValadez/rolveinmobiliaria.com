                <tr>
                  <td class="text-center">
                    @can('calls.update')
                      @callsButtonEdit(['call' => $call])
                      @endcallsButtonEdit
                    @endcan

                    @can('calls.delete')
                      @callsButtonDelete(['call' => $call])
                      @endcallsButtonDelete
                    @endcan
                  </td>
                  <td class="text-center">
                    <a href="{{ route('show_call', ['id' => $call->id]) }}">
                      {{ $call->internal_expedient->expedient }}
                    </a>
                  </td>
                  <td class="text-center">
                    <span class="label
                    @if ($call->priority == 'Baja')
                      label-primary
                    @elseif ($call->priority == 'Media')
                      label-warning
                    @else
                      label-danger
                    @endif">{{ $call->priority }}</span>
                  </td>
                  <td>{{ $call->internal_expedient->client->full_name }}</td>
                  <td class="hidden-xs hidden-sm">{{ $call->observations }}</td>
                  <td class="text-center">{{ $call->status }}</td>
                  <td class="text-center">{{ $call->type_of_operation }}</td>
                  <td class="text-center">
                    {{ $call->user->name }}
                  </td>
                  <td>{{ (isset($call->updated)) ? $call->updated : $call->created }}</td>
                </tr>
