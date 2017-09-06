<div class="list-group">
  <a
    href="{{ route('call_trackings') }}"
    class="list-group-item
      @if (
        $uri == 'call_trackings' ||
        $uri == 'seguimiento_de_llamadas'
      )
        active
      @endif"
    title="@lang('section.call_tracking')">
    @lang('section.call_tracking')
  </a>
  <a
    href="#"
    class="list-group-item
      @if (
        $uri == 'for_sales' ||
        $uri == 'compra_venta'
      )
        active
      @endif"
    title="@lang('section.for_sale')">
    @lang('section.for_sale')
  </a>
  <!--
  <a
    href="#"
    class="list-group-item
      @if (
        $uri == 'for_rent' ||
        $uri == 'renta'
      )
        active
      @endif"
    title="@lang('section.rent')">
    @lang('section.rent')
  </a>
  <a
    href="#"
    class="list-group-item
      @if (
        $uri == 'mortgage_cancellation' ||
        $uri == 'cancelacion_de_hipoteca'
      )
        active
      @endif"
    title="@lang('section.mortgage_cancellation')">
    @lang('section.mortgage_cancellation')
  </a>
  <a
    href="#"
    class="list-group-item
      @if (
        $uri == 'legal' ||
        $uri == 'juridico'
      )
        active
      @endif"
    title="@lang('section.legal')">
    @lang('section.legal')
  </a>
  <a
    href="#"
    class="list-group-item
      @if (
        $uri == 'succession' ||
        $uri == 'sucesion'
      )
        active
      @endif"
    title="@lang('section.succession')">
    @lang('section.succession')
  </a>
  -->
</div>
