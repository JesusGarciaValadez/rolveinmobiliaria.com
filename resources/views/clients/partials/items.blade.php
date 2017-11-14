                <tr>
                  <td class="text-center">
                    @can('clients.update')
                      @include('clients.partials.buttons.edit')
                    @endcan

                    @can('clients.delete')
                      @include('clients.partials.buttons.delete')
                    @endcan
                  </td>
                  <td class="text-center">
                    <a
                      href="{{ route('show_client', $client->id) }}"
                      target="_self"
                      title="{{ $client->full_name }}"
                    >
                      {{ $client->full_name }}
                    </a>
                  </td>
                  <td class="text-center">
                    {{ $client->phone_1 }}
                  </td>
                  <td class="text-center">
                    {{ $client->phone_2 }}
                  </td>
                  <td class="text-center">
                    {{ $client->business }}
                  </td>
                  <td class="text-center">
                    <a
                      href="mailto:{{ $client->email }}"
                      target="_self"
                      title="@lang('shared.send_email_to') {{ $client->name }}"
                    >
                      {{ $client->email }}
                    </a>
                  </td>
                  <td class="text-center">
                    {{ $client->reference }}
                  </td>
                </tr>
