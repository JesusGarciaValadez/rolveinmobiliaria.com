<div class="panel panel-default" v-cloak>
  <div class="panel-heading">
    <h4 class="panel-title">@lang('sale.log_of_visits_and_calls')</h4>
  </div>
  <div class="panel-body">
    <p class="block">
      <button
        type="button"
        class="btn btn-success"
        data-toggle="modal"
        data-target="#newLogAndVisit">
        @lang('sale.log_of_visits_and_calls_new')
      </button>
    </p>

    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>
          <th class="text-center">@lang('shared.date')</th>
          <th class="text-center">@lang('shared.subject')</th>
          <th class="text-center">@lang('shared.email')</th>
          <th class="text-center">@lang('shared.phone')</th>
          <th class="text-center">@lang('shared.observations')</th>
        </tr>
      </thead>

      <tfoot>
        <tr>
          <td colspan="5"></td>
        </tr>
      </tfoot>

      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
