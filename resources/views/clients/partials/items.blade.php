                <tr>
                  <td class="text-center">
                    @can('clients.update')
                      @clientsButtonEdit(['client' => $client])
                      @endclientsButtonEdit
                    @endcan

                    @can('clients.delete')
                      @clientsButtonDelete(['client' => $client])
                      @endclientsButtonDelete
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
                      href="mailto:{{ $client->email_1 }}"
                      target="_self"
                      title="@lang('shared.send_email_to') {{ $client->name }}"
                    >
                      {{ $client->email_1 }}
                    </a>
                  </td>
                  <td class="text-center">
                    <a
                      href="mailto:{{ $client->email_2 }}"
                      target="_self"
                      title="@lang('shared.send_email_to') {{ $client->name }}"
                    >
                      {{ $client->email_2 }}
                    </a>
                  </td>
                  <td class="text-center">
                    {{ $client->reference }}
                  </td>
                </tr>
