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
      'expedient' => 'required|string',
      'type_of_operation' => [
        'sometimes',
        'required' => Rule::in([
          'Venta',
          'Renta',
          'Contratos de exclusividad',
          'Jurídico',
          'Avalúos',
        ]),
      ],
      'client' => 'required|string',
      'client_phone_1' => 'required|string',
      'client_phone_2' => 'sometimes|nullable|string',
      'email' => 'sometimes|nullable|email',
      'address' => 'sometimes|nullable|string',
      'state_id' => 'sometimes|nullable|numeric|integer|exists:states,id',
      'observations' => 'required|string',
      'status' => [
        'sometimes',
        'required' => Rule::in([
          'Abierto',
          'Cerrado',
        ]),
      ],
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
