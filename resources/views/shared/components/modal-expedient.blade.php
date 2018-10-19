<div
  class="modal bs-example-modal-lg"
  id="newExpedient"
  tabindex="-1"
  role="dialog"
  aria-labelledby="makeANewExpedient"
  aria-describedby="makeANewExpedient">
  <modal-expedient
    route="{{ route('internal_expedient.store') }}"
    csrf="{{ csrf_token() }}"
    initial-clients="{{ $clients }}"
  ></modal-expedient>
</div>
