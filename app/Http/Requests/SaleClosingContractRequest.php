<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleClosingContractRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return \Auth::check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'SCC_commercial_valuation' => 'nullable|string',
      'SCC_exclusivity_contract' => 'nullable|string',
      'SCC_publication' => 'nullable|string',
      'SCC_data_sheet' => 'nullable|file|mimes:doc,docx,pdf',
      'SCC_closing_contract_observations' => 'nullable|string'
    ];
  }
}
