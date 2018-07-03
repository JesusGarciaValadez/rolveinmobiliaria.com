                <tr>
                  <td class="text-center active">{{-- Internal Expedient --}}
                    <a
                      href="{{ route('show_sale', $sale->internal_expedient->id) }}"
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
                    @if(empty($sale->seller) || $sale->seller->SD_complete === 0)
                    <a href="{{ route('edit_seller', [
                        'id' => $sale->id,
                        'seller_id' => $sale->seller->id
                      ]) }}" title="Editar documentos" class="btn btn-warning">
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                    </a>
                    @else
                    <a href="{{ route('edit_seller', [
                        'id' => $sale->id,
                        'seller_id' => $sale->seller->id,
                      ]) }}" title="Documentos completos" class="btn btn-success">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                    </a>
                    @endif
                  </td>
                  <td class="text-center">{{-- Closing Contract --}}
                    @if(
                      empty($sale->closing_contract) ||
                      $sale->closing_contract->SCC_complete === 0
                    )
                    <a href="{{ route('edit_closing_contract', [
                        'id' => $sale->id,
                        'closing_contract_id' => $sale->closing_contract->id,
                      ]) }}" title="Editar contrato de cierre" class="btn btn-warning">
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                    </a>
                    @else
                    <a href="{{ route('edit_closing_contract', [
                        'id' => $sale->id,
                        'closing_contract_id' => $sale->closing_contract->id,
                      ]) }}" title="Contrato de cierre completo" class="btn btn-success">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                    </a>
                    @endif
                  </td>
                  <td class="text-center">{{-- Logs --}}
                    @if(
                      empty($sale->notary) ||
                      $sale->notary->SN_complete === 0
                    )
                    <a href="{{ route('edit_log', [
                        'id' => $sale->id,
                        'log_id' => $sale->id,
                      ]) }}" title="Editar contrato de cierre" class="btn btn-warning">
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                    </a>
                    @else
                    <a href="{{ route('edit_log', [
                        'id' => $sale->id,
                        'log_id' => $sale->id,
                      ]) }}" title="Contrato de cierre completo" class="btn btn-success">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                    </a>
                    @endif
                  </td>
                  <td class="text-center">{{-- Contract --}}
                    @if(
                      empty($sale->contract) ||
                      $sale->contract->SC_complete === 0
                    )
                    <a href="{{ route('edit_contract', [
                        'id' => $sale->id,
                        'contract_id' => $sale->contract->id,
                      ]) }}" title="Editar contrato" class="btn btn-warning">
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                    </a>
                    @else
                    <a href="{{ route('edit_contract', [
                        'id' => $sale->id,
                        'contract_id' => $sale->contract->id,
                      ]) }}" title="Contrato completo" class="btn btn-success">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                    </a>
                    @endif
                  </td>
                  <td class="text-center">{{-- Notary --}}
                    @if(
                      empty($sale->notary) ||
                      $sale->notary->SN_complete === 0
                    )
                    <a href="{{ route('edit_notary', [
                        'id' => $sale->id,
                        'notary_id' => $sale->notary->id,
                      ]) }}" title="Editar notaría" class="btn btn-warning">
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                    </a>
                    @else
                    <a href="{{ route('edit_notary', [
                        'id' => $sale->id,
                        'notary_id' => $sale->notary->id,
                      ]) }}" title="Editar notaría" class="btn btn-success">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                    </a>
                    @endif
                  </td>
                  <td class="text-center">{{-- Signature --}}
                    @if(
                      empty($sale->signature) ||
                      $sale->signature->SS_complete === 0
                    )
                    <a href="{{ route('edit_signature', [
                        'id' => $sale->id,
                        'signature_id' => $sale->signature->id,
                      ]) }}" title="Editar notaría" class="btn btn-warning">
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Completar
                    </a>
                    @else
                    <a href="{{ route('edit_signature', [
                        'id' => $sale->contract->id,
                        'signature_id' => $sale->signature->id,
                      ]) }}" title="Firma completa" class="btn btn-success">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Completo
                    </a>
                    @endif
                  </td>
                  <td class="text-center danger">{{-- Actions --}}
                    @can('sales.delete')
                      @salesButtonDelete(['sale' => $sale])
                      @endsalesButtonDelete
                    @endcan
                  </td>
                </tr>
