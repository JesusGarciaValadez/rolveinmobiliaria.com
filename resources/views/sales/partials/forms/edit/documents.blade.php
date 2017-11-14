<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="documents">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Documentos
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="documents">
    <div class="panel-body">
      <form
        class="form-horizontal"
        action="{{ route('update_sale_documents', [
          'id' => request('id')
        ]) }}"
        method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="user_id" value="{{ $sale->user_id }}">

        <div class="form-inline">
          @include('sales.partials.buttons.save')
        </div>
      </form>
    </div>
  </div>
</div>
