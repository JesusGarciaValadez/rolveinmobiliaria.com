Rolve

{{ $saleCreated->user->name }} atendió a [{{ $saleCreated->internal_expedient->client->full_name }}] ({{ route('show_sale', ['id' => $saleCreated->id ]) }}) creando una nueva compraventa.

[Correo de {{ $saleCreated->intenal_expedient->client->full_name }}]({{ $saleCreated->intenal_expedient->client->email }})

[Ver compraventa en el navegador]({{ route('show_sale', ['id' => $saleCreated->id ]) }})
