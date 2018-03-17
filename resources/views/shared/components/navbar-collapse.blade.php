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
          @can('messages.view')
            <li class="hidden-md hidden-lg">
              <a href="{{ route('messages') }}" title="@lang('section.messages')">
                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                @lang('section.messages')
              </a>
            </li>
          @endcan
          @can('clients.view')
            <li class="hidden-md hidden-lg">
              <a href="{{ route('clients') }}" title="@lang('section.clients')">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                @lang('section.clients')
              </a>
            </li>
          @endcan
          @can('calls.view')
            <li class="hidden-md hidden-lg">
              <a href="{{ route('call_trackings') }}" title="@lang('section.call_tracking')">
                <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                @lang('section.call_tracking')
              </a>
            </li>
          @endcan
          @can('sales.view')
            <li class="hidden-md hidden-lg">
              <a href="{{ route('for_sales') }}" title="@lang('section.for_sale')">
                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                @lang('section.for_sale')
              </a>
            </li>
          @endcan
          @can('user.view')
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
