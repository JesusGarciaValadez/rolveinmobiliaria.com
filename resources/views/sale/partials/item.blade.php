                <tr>
                  <td class="text-center">
                    {{ $sale->internalExpedient->expedient }}
                  </td>
                  <td class="text-center">
                    {{ $sale->internalExpedient->client->name }}
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
                  <td class="text-center">
                    @include('sale.partials.buttons.edit')

                    @include('sale.partials.buttons.delete', ['sale' => $sale])
                  </td>
                </tr>
