                <tr>
                  <td class="text-center">
                    @can('sales.update')
                      @salesButtonEdit(['sale' => $sale])
                      @endsalesButtonEdit
                    @endcan

                    @can('sales.delete')
                      @salesButtonDelete(['sale' => $sale])
                      @endsalesButtonDelete
                    @endcan
                  </td>
                  <td class="text-center">
                    {{ $sale->internal_expedient->expedient }}
                  </td>
                  <td class="text-center">
                    {{ $sale->internal_expedient->client->full_name }}
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (empty($sale->document) || $sale->document->SD_complete === 0)
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (empty($sale->document) || $sale->document->SD_complete === 0)
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->closing_contract) ||
                          $sale->closing_contract->SCC_complete === 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->closing_contract) ||
                            $sale->closing_contract->SCC_complete === 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->document) ||
                          $sale->document->complete === 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->document) ||
                            $sale->document->complete === 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->contract) ||
                          $sale->contract->SC_complete === 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->contract) ||
                            $sale->contract->SC_complete === 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->notary) ||
                          $sale->notary->SN_complete === 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->notary) ||
                            $sale->notary->SN_complete === 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="label
                      {{ (
                          empty($sale->signature) ||
                          $sale->signature->SS_complete === 0
                        )
                        ? 'label-warning'
                        : 'label-primary' }}">
                        {{ (
                            empty($sale->signature) ||
                            $sale->signature->SS_complete === 0
                          )
                          ? 'Incompleto'
                          : 'Completo' }}
                    </span>
                  </td>
                </tr>
