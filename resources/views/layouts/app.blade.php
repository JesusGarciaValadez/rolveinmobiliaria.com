<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-control" content="private">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="canonical" href="{{ url()->current() }}" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <link rel="canonical" href="{{ url()->current() }}">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style media="screen">
    [v-cloak] {
      display: none;
    }
  </style>
</head>
<body>
  <div>
    @navbar(['uri' => $uri])
    @endnavbar

    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/manifest.js') }}"></script>
  <script src="{{ asset('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
  @yield('scripts')
</body>
</html>
