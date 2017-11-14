                <tr>
                  <td class="text-center">
                    @can('sales.update')
                      @include('sales.partials.buttons.edit')
                    @endcan

                    @can('sales.delete')
                      @include('sales.partials.buttons.delete', [
                        'sale' => $sale
                      ])
                    @endcan
                  </td>
                  <td class="text-center">
                    <a
                      href="{{ route('show_sale', $sale->internalExpedient->id) }}"
                      target="_self"
                      title="{{ $sale->internalExpedient->client->full_name }}"
                    >
                      {{ $sale->internalExpedient->expedient }}
                    </a>
                  </td>
                  <td class="text-center">
                    {{ $sale->internalExpedient->client->full_name }}
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (empty($sale->document) || $sale->document->complete == 0)
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (empty($sale->document) || $sale->document->complete == 0)
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->closingContract) ||
                          $sale->closingContract->complete == 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->closingContract) ||
                            $sale->closingContract->complete == 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->document) ||
                          $sale->document->complete == 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->document) ||
                            $sale->document->complete == 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->document) ||
                          $sale->document->complete == 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->document) ||
                            $sale->document->complete == 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->document) ||
                          $sale->document->complete == 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->document) ||
                            $sale->document->complete == 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->document) ||
                          $sale->document->complete == 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->document) ||
                            $sale->document->complete == 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                </tr>
