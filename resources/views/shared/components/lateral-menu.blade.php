<div class="hidden-xs hidden-sm col-md-1 col-lg-1">
  <div class="list-group text-center">
    <a
      href="{{ route('dashboard') }}"
      class="list-group-item{{ (!empty($uri) && $uri == 'dashboard')
        ? ' active'
        : '' }}"
      title="@lang('section.dashboard')"
      data-toggle="tooltip"
      data-placement="right">
      <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
    </a>
  @can('messages.view')
    <a
      href="{{ route('messages') }}"
      class="list-group-item {{ (!empty($uri) && $uri == 'messages')
        ? ' active'
        : '' }}"
      title="@lang('section.messages')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon glyphicon-send"
        aria-hidden="true"></span>
    </a>
  @endcan
  @can('clients.view')
    <a
      href="{{ route('clients') }}"
      class="list-group-item {{ (!empty($uri) && $uri == 'clients')
        ? ' active'
        : '' }}"
      title="@lang('section.clients')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon glyphicon-user"
        aria-hidden="true"></span>
    </a>
  @endcan
  @can('calls.view')
    <a
      href="{{ route('call_trackings') }}"
      class="list-group-item{{ (!empty($uri) && $uri == 'call_trackings')
        ? ' active'
        : '' }}"
      title="@lang('section.call_tracking')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon-phone"
        aria-hidden="true"></span>
    </a>
  @endcan
  @can('sales.view')
    <a
      href="{{ route('for_sales') }}"
      class="list-group-item {{ (!empty($uri) && $uri == 'for_sales')
        ? ' active'
        : '' }}"
      title="@lang('section.for_sale')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon-usd"
        aria-hidden="true"></span>
    </a>
  @endcan
  <!--
    <a
      href="#"
      class="list-group-item{{ (!empty($uri) && $uri == 'for_rent')
      ? ' active'
      : '' }}"
      title="@lang('section.rent')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon-credit-card"
        aria-hidden="true"></span>
    </a>
    <a
      href="#"
      class="list-group-item{{ (!empty($uri) && $uri == 'mortgage_cancellation')
      ? 'active'
      : '' }}"
      title="@lang('section.mortgage_cancellation')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon-fire"
        aria-hidden="true"></span>
    </a>
    <a
      href="#"
      class="list-group-item{{ (!empty($uri) && $uri == 'legal')
      ? 'active'
      : '' }}"
      title="@lang('section.legal')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon-briefcase"
        aria-hidden="true"></span>
    </a>
    <a
      href="#"
      class="list-group-item{{ (!empty($uri) && $uri == 'succession')
      ? 'active'
      : '' }}"
      title="@lang('section.succession')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon-calendar"
        aria-hidden="true"></span>
    </a>
  -->
  </div>
</div>
