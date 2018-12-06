<div class="panel panel-default">
  <client-filter
    route="{{ route('client.filter') }}"
    csrf="{{ csrf_token() }}"
    @if (request('filter_by'))
    initial-filter-by="{{ request('filter_by') }}"
    @endif
    @if (!empty(request('filter_by')))
    initial-value="{{ request('first_name') }}"
    @endif
    @if (!empty(request('filter_by')))
    initial-value="{{ request('last_name') }}"
    @endif
    @if (!empty(request('phone_1')))
    initial-value="{{ request('phone_1') }}"
    @endif
    @if (!empty(request('phone_2')))
    initial-value="{{ request('phone_2') }}"
    @endif
    @if (!empty(request('business')))
    initial-value="{{ request('business') }}"
    @endif
    @if (!empty(request('email_1')))
    initial-value="{{ request('email_1') }}"
    @endif
    @if (!empty(request('email_2')))
    initial-value="{{ request('email_2') }}"
    @endif
    @if (!empty(request('reference')))
    initial-value="{{ request('reference') }}"
    @endif
    @if ($errors)
    errors="{{ $errors }}"
    @endif
  ></client-filter>
</div>
