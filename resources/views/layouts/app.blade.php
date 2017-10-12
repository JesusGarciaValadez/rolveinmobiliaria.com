<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
              <li><a href="{{ route('login') }}">@lang('auth.login')</a></li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <span aria-hidden="true" class="glyphicon glyphicon-user"></span>
                  {{ Auth::user()->name }}
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  @can('calls.menu', App\Call::class)
                    <li class="hidden-md hidden-lg">
                      <a href="{{ route('call_trackings') }}" title="@lang('section.call_tracking')">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        @lang('section.call_tracking')
                      </a>
                    </li>
                  @endcan
                  @can('sales.menu', App\Sale::class)
                    <li class="hidden-md hidden-lg">
                      <a href="#" title="@lang('section.for_sale')">
                        <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                        @lang('section.for_sale')
                      </a>
                    </li>
                  @endcan
                  <li>
                    <a href="{{ route('register') }}">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                      @lang('auth.register_a_new_user')
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                      <span aria-hidden="true" class="glyphicon glyphicon-log-out"></span>
                      @lang('auth.logout')
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</body>
</html>
