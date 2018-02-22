<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nuevo recado creado</title>
  </head>
  <body>
    <div>
      <img src="{{ secure_asset('img/rolve-inmobiliaria.jpg') }}" alt="">
    </div>
    <div>
      {{ $messageCreated->user->name }} atendió a <a href="mailto:{{ $messageCreated->email }}" title="{{ $messageCreated->name }}">{{ $messageCreated->name }}</a> con las siguientes observaciones:
    </div>
    <div>
      {{ $messageCreated->observations }}
    </div>
    <div>
      <p><a href="{{ route('show_message', ['id' => $messageCreated->id ]) }}">Ver mensaje</a></p>
    </div>
  </body>
</html>
