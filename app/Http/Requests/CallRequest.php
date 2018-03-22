<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CallRequest extends FormRequest
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
      'type_of_operation' => [
        'sometimes',
        'required' => Rule::in([
          'Venta',
          'Renta',
          'Contratos de exclusividad',
          'Jurídico',
          'Avalúos',
          'Recados',
        ]),
      ],
      'internal_expedient_id' => 'nullable|alpha_num',
      'expedient_key' => 'required|alpha_num',
      'expedient_number' => 'required|alpha_num',
      'expedient_year' => 'required|alpha_num',
      'client_id' => 'required|alpha_num',
      'address' => 'sometimes|nullable|string',
      'state_id' => 'sometimes|nullable|numeric|integer|exists:states,id',
      'observations' => 'required|string',
      'status' => 'sometimes|nullable|string',
      'priority' => [
        'sometimes',
        'required' => Rule::in([
          'Baja',
          'Media',
          'Alta',
        ]),
      ],
    ];
  }
}
