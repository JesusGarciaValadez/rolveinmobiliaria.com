<seller
  initial-sale="{{ $sale }}"
  initial-clients="{{ $clients->toJson() }}"
  initial-expedients="{{ $expedients->toJson() }}"
  @if (!empty($errors))
  errors="{{ $errors->toJson() }}"
  @endif
></seller>
