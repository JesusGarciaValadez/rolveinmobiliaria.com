<div class="panel panel-default">
  <form
    class="panel-heading form-horizontal clearfix"
    role="search"
    action="{{ route('filter_message') }}"
    method="get">
    @csrf

    <div class="form-group clearfix{{ $errors->has('date') ? ' has-error' : ''}}">
      <label for="date" class="form-label col-xs-12 col-sm-6 col-md-6 col-lg-6">Filtrar por: </label>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <select name="date" id="date" class="form-control input-sm" required autofocus>
          <option
            value="{{ now()->today() }}"
            {{ session('date') == now()->today() ? 'selected' : '' }}>
            Hoy
          </option>
          <option
            value="{{ now()->today()->subDays(5) }}"
            {{ session('date') == now()->today()->subDays(5) ? 'selected' : '' }}>
            Últimos 5 días
          </option>
          <option
            value="{{ now()->today()->subWeeks(2) }}"
            {{ session('date') == now()->today()->subWeeks(2) ? 'selected' : '' }}>
            Últimos 2 semanas
          </option>
          <option
            value="{{ now()->today()->subMonth() }}"
            {{ session('date') == now()->today()->subMonth() ? 'selected' : '' }}>
            Último mes
          </option>
          <option
            value="{{ now()->today()->subMonths(6) }}"
            {{ session('date') == now()->today()->subMonths(6) ? 'selected' : '' }}>
            Últimos 6 meses
          </option>
        </select>
      </div>
    </div>

    <div class="form-group text-center{{ $errors->has('date') ? ' has-error' : ''}}">
      <button type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-search"></span> Buscar</button>
    </div>

    @if ($errors->has('date'))
      <span class="help-block">
        <strong>{{ $errors->first('date') }}</strong>
      </span>
    @endif
  </form>
</div>
