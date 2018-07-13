                <tr>
                  <td class="text-center active">{{-- Internal Expedient --}}
                    <a
                      href="{{ route('for_sale.edit', $sale->internal_expedient->id) }}"
                      target="_self"
                      title="{{ $sale->internal_expedient->client->full_name }}"
                    >
                      {{ $sale->internal_expedient->expedient }}
                    </a>
                  </td>
                  <td class="text-center active">{{-- Client --}}
                    {{ $sale->internal_expedient->client->full_name }}
                  </td>
                  <td class="text-center">{{-- Documents --}}
                    <a
                      @if(
                        $sale->seller->SD_complete === 0 ||
                        $sale->seller->SD_complete === 1
                      )
                      href="{{ route('for_sale.seller.edit', [
                        'sale' => $sale->id,
                        'seller' => $sale->seller->id
                      ]) }}"
                      @endif
                      @if ($sale->seller->SD_complete === 1)
                      title="Documentos completos"
                      class="btn btn-success">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                      @else
                      title="Editar documentos"
                      class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                      @endif
                    </a>
                  </td>
                  <td class="text-center">{{-- Closing Contract --}}
                    <a
                      @if(
                        $sale->closing_contract->SCC_complete === 0 ||
                        $sale->closing_contract->SCC_complete === 1
                      )
                      href="{{ route('for_sale.closing_contract.edit', [
                        'sale' => $sale->id,
                        'closing_contract' => $sale->closing_contract->id,
                      ]) }}"
                      @endif
                      @if($sale->closing_contract->SCC_complete === 1)
                      title="Contrato de cierre completo"
                      class="btn btn-success">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                      @else
                      title="Editar contrato de cierre"
                      class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                      @endif
                    </a>
                  </td>
                  <td class="text-center">{{-- Visits --}}
                    <a
                      @if(
                        $sale->visit->SV_complete === 0 ||
                        $sale->visit->SV_complete === 1
                      )
                      href="{{ route('for_sale.visit.edit', [
                        'sale' => $sale->id,
                        'visit' => $sale->id,
                      ]) }}"
                      @endif
                      @if($sale->visit->SV_complete === 1)
                      title="Editar contrato de cierre"
                      class="btn btn-warning">
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                      @else
                      title="Contrato de cierre completo"
                      class="btn btn-success">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                      @endif
                    </a>
                  </td>
                  <td class="text-center">{{-- Contract --}}
                    <a
                      @if(
                        $sale->contract->SC_complete === 0 ||
                        $sale->contract->SC_complete === 1
                      )
                      href="{{ route('for_sale.contract.edit', [
                        'sale' => $sale->id,
                        'contract' => $sale->contract->id,
                      ]) }}"
                      @endif
                      @if($sale->contract->SC_complete === 1)
                      title="Contrato completo"
                      class="btn btn-success">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                      @else
                      title="Editar contrato"
                      class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                      @endif
                    </a>
                  </td>
                  <td class="text-center">{{-- Notary --}}
                    <a
                      @if(
                        $sale->notary->SN_complete === 0 ||
                        $sale->notary->SN_complete === 1
                      )
                      href="{{ route('for_sale.notary.edit', [
                        'sale' => $sale->id,
                        'notary' => $sale->notary->id,
                      ]) }}"
                      @endif
                      @if($sale->notary->SN_complete === 1)
                      title="Notaría completa"
                      class="btn btn-success">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                      @else
                      title="Editar notaría"
                      class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                      @endif
                    </a>
                  </td>
                  <td class="text-center">{{-- Signature --}}
                    <a
                      @if(
                        $sale->signature->SS_complete === 0 ||
                        $sale->signature->SS_complete === 1
                      )
                      href="{{ route('for_sale.signature.edit', [
                        'sale' => $sale->id,
                        'signature' => $sale->signature->id,
                      ]) }}"
                      @endif
                      @if(optional($sale->signature)->SS_complete === 1)
                      title=""
                      class="btn btn-success">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                      @else
                      title="Editar firma"
                      class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                      @endif
                    </a>
                  </td>
                  <td class="text-center danger">{{-- Actions --}}
                    @can('sales.delete')
                      @salesButtonDelete(['sale' => $sale])
                      @endsalesButtonDelete
                    @endcan
                  </td>
                </tr>
