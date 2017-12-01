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
                    {{ $client->full_name }}
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
