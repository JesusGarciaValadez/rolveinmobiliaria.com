Rolve

{{ $messageCreated->user->name }} atendió a [{{ $messageCreated->name }}] ({{ route('show_message', ['id' => $messageCreated->id ]) }}) con las siguientes observaciones:

{{ $messageCreated->observations }}

[Correo de {{ $messageCreated->name }}]({{ $messageCreated->email }})

[Ver mensaje en el navegador]({{ route('show_message', ['id' => $messageCreated->id ]) }})
