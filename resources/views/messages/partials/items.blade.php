                <tr>
                  <td class="text-center">
                    @can('messages.update')
                      @messagesButtonEdit(['message' => $message])
                      @endmessagesButtonEdit
                    @endcan

                    @can('messages.delete')
                      @messagesButtonDelete(['message' => $message])
                      @endmessagesButtonDelete
                    @endcan
                  </td>
                  <td class="text-center">
                    <a href="{{ route('show_message', ['id' => $message->id]) }}">{{ $message->name }}</a>
                  </td>
                  <td class="hidden-xs hidden-sm">{{ $message->observations }}</td>
                  <td class="text-center">{{ $message->user->name }}</td>
                  <td>{{ isset($message->updated)
                        ? $message->updated
                        : $message->created }}</td>
                </tr>
