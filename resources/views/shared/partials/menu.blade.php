<div class="hidden-xs hidden-sm col-md-1 col-lg-1">
  <div class="list-group text-center">
    <a
      href="{{ route('dashboard') }}"
      class="list-group-item{{ $uri == 'dashboard' ? ' active' : '' }}"
      title="@lang('section.dashboard')"
      data-toggle="tooltip"
      data-placement="right">
      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
    </a>
  @can('calls.menu', App\Call::class)
    <a
      href="{{ route('call_trackings') }}"
      class="list-group-item{{ $uri == 'call_trackings' ? ' active' : '' }}"
      title="@lang('section.call_tracking')"
      data-toggle="tooltip"
      data-placement="right">
      <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
    </a>
  @endcan
  <!--
  @can('sales.menu', App\Sale::class)
    <a
      href="#"
      class="list-group-item {{ $uri == 'for_sales' ? ' active' : '' }}"
      title="@lang('section.for_sale')"><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>@lang('section.for_sale')</a>
  @endcan
    <a
      href="#"
      class="list-group-item{{ $uri == 'for_rent' ? ' active' : '' }}"
      title="@lang('section.rent')"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> @lang('section.rent')</a>
    <a
      href="#"
      class="list-group-item{{ $uri == 'mortgage_cancellation' ? 'active' : '' }}"
      title="@lang('section.mortgage_cancellation')"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span> @lang('section.mortgage_cancellation')</a>
    <a
      href="#"
      class="list-group-item{{ $uri == 'legal' ? 'active' : '' }}"
      title="@lang('section.legal')"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> @lang('section.legal')</a>
    <a
      href="#"
      class="list-group-item{{ $uri == 'succession' ? 'active' : '' }}"
      title="@lang('section.succession')"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> @lang('section.succession')</a>
  -->
  </div>
</div>
