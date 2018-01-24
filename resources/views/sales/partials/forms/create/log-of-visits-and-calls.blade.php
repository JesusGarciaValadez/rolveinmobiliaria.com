<div class="panel panel-default" v-show="showLogOfVisitsAndCalls" v-cloak>
  <div class="panel-heading" role="tab" id="logOfVisitsAndCalls">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
        @lang('sale.log_of_visits_and_calls')
      </a>
    </h4>
  </div>
  <div id="collapseThree" class="panel-collapse collapse-in collapse in" role="tabpanel" aria-labelledby="logOfVisitsAndCalls">
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
</div>
