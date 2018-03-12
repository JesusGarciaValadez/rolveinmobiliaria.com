<div class="panel panel-default">
  <form class="panel-heading form-inline clearfix" role="search" action="{{ route('filter_call') }}" method="get">
    {{ csrf_field() }}
    <div class="form-group col-xs-12 col-sm-5 col-md-4 col-lg-3{{ $errors->has('date') ? ' has-error' : ''}}">
      <label for="date" class="form-label">Filtrar por: </label>

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

    <div class="form-group col-xs-3 col-xs-offset-4 col-sm-7 col-sm-offset-0 col-md-8 col-md-offset-0 col-lg-9 col-lg-offset-0">
      <button type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-search"></span> Buscar</button>
    </div>

    @if ($errors->has('date'))
      <span class="help-block">
        <strong>{{ $errors->first('date') }}</strong>
      </span>
    @endif
  </form>
</div>
