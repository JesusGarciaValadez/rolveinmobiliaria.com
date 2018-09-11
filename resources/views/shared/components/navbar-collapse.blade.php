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
          @can('message.create')
            <li class="hidden-md hidden-lg{{ (!empty($uri) && $uri == 'messages')
              ? ' active'
              : '' }}">
              <a href="{{ route('message.index') }}" title="@lang('section.message')">
                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                @lang('section.message')
              </a>
            </li>
          @endcan
          @can('client.create')
            <li class="hidden-md hidden-lg{{ (!empty($uri) && $uri == 'clients')
              ? ' active'
              : '' }}">
              <a href="{{ route('client.index') }}" title="@lang('section.client')">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                @lang('section.client')
              </a>
            </li>
          @endcan
          @can('call.create')
            <li class="hidden-md hidden-lg{{ (!empty($uri) && $uri == 'call')
              ? ' active'
              : '' }}">
              <a href="{{ route('call.index') }}" title="@lang('section.call')">
                <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                @lang('section.call')
              </a>
            </li>
          @endcan
          @can('sale.create')
            <li class="hidden-md hidden-lg{{ (!empty($uri) && $uri == 'dashboard')
              ? ' for_sales'
              : '' }}">
              <a href="{{ route('sale.index') }}" title="@lang('section.sale')">
                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                @lang('section.sale')
              </a>
            </li>
          @endcan
          <li role="separator" class="divider"></li>
          @can('user.create')
          <li>
            <a href="{{ route('register') }}">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              @lang('auth.register_a_new_user')
            </a>
          </li>
          @endcan
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
