                <tr>
                  <td class="text-center">
                    @can('calls.update')
                      @include('calls.partials.buttons.edit')
                    @endcan

                    @can('calls.delete')
                      @include('calls.partials.buttons.delete')
                    @endcan
                  </td>
                  <td>
                    <a href="{{ route('show_call', ['id' => $call->id]) }}">
                      {{ $call->expedient }}
                    </a>
                  </td>
                  <td>{{ $call->type_of_operation }}</td>
                  <td>{{ $call->client->full_name }}</td>
                  <td>{{ $call->client->phone_1 }}</td>
                  <td>
                    <a href="mailto:{{ $call->client->email }}" title="@lang('shared.send_email_to') {{ $call->client->name }}" target="_blank">{{ $call->client->email }}</a>
                  </td>
                  <td class="hidden-xs hidden-sm">{{ $call->observations }}</td>
                  <td>{{ $call->address }}</td>
                  <td>{{ $call->state->name }}</td>
                  <td>{{ (isset($call->updated)) ? $call->updated : $call->created }}</td>
                  <td>{{ $call->status }}</td>
                  <td class="text-center"><span class="label
                    @if ($call->priority == 'Baja')
                      label-primary
                    @elseif ($call->priority == 'Media')
                      label-warning
                    @else
                      label-danger
                    @endif">{{ $call->priority }}</span></td>
                </tr>
