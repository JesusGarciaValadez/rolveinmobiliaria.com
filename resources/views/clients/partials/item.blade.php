                <tr>
                  <td class="text-center">
                    @include('clients.partials.buttons.edit')

                    @include('clients.partials.buttons.delete')
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
