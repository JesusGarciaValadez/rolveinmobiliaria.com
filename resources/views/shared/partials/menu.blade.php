<div class="hidden-xs hidden-sm col-md-3 col-lg-3">
  <div class="list-group">
    <a
      href="{{ route('dashboard') }}"
      class="list-group-item{{ $uri == 'dashboard' ? ' active' : '' }}"
      title="@lang('section.call_tracking')">Dashboard</a>
  @can('calls.menu', App\Call::class)
    <a
      href="{{ route('call_trackings') }}"
      class="list-group-item{{ $uri == 'call_trackings' ? ' active' : '' }}"
      title="@lang('section.call_tracking')">@lang('section.call_tracking')</a>
  @endcan
  <!--
  @can('sales.menu', App\Sale::class)
    <a
      href="#"
      class="list-group-item {{ $uri == 'for_sales' ? ' active' : '' }}"
      title="@lang('section.for_sale')">@lang('section.for_sale')</a>
  @endcan
    <a
      href="#"
      class="list-group-item{{ $uri == 'for_rent' ? ' active' : '' }}"
      title="@lang('section.rent')">@lang('section.rent')</a>
    <a
      href="#"
      class="list-group-item{{ $uri == 'mortgage_cancellation' ? 'active' : '' }}"
      title="@lang('section.mortgage_cancellation')">@lang('section.mortgage_cancellation')</a>
    <a
      href="#"
      class="list-group-item{{ $uri == 'legal' ? 'active' : '' }}"
      title="@lang('section.legal')">@lang('section.legal')</a>
    <a
      href="#"
      class="list-group-item{{ $uri == 'succession' ? 'active' : '' }}"
      title="@lang('section.succession')">@lang('section.succession')</a>
  -->
  </div>
</div>
