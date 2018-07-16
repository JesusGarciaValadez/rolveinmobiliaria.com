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
  @can('message.view')
    <a
      href="{{ route('message.index') }}"
      class="list-group-item {{ (!empty($uri) && $uri == 'message')
        ? ' active'
        : '' }}"
      title="@lang('section.message')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon glyphicon-send"
        aria-hidden="true"></span>
    </a>
  @endcan
  @can('client.view')
    <a
      href="{{ route('client.index') }}"
      class="list-group-item {{ (!empty($uri) && $uri == 'client')
        ? ' active'
        : '' }}"
      title="@lang('section.client')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon glyphicon-user"
        aria-hidden="true"></span>
    </a>
  @endcan
  @can('call.view')
    <a
      href="{{ route('call.index') }}"
      class="list-group-item{{ (!empty($uri) && $uri == 'call')
        ? ' active'
        : '' }}"
      title="@lang('section.call')"
      data-toggle="tooltip"
      data-placement="right">
      <span
        class="glyphicon glyphicon-phone"
        aria-hidden="true"></span>
    </a>
  @endcan
  @can('sale.view')
    <a
      href="{{ route('sale.index') }}"
      class="list-group-item {{ (!empty($uri) && $uri == 'sale')
        ? ' active'
        : '' }}"
      title="@lang('section.sale')"
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
