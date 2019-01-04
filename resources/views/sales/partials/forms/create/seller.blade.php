<seller
  initial-clients="{{ $clients->toJson() }}"
  initial-expedients="{{ $expedients->toJson() }}"
  @if (!empty($errors))
  errors="{{ $errors }}"
  @endif
></seller>
