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
        'required' => Rule::in([
          'Venta',
          'Renta',
          'Regularización',
          'Jurídico',
          'Sucesión'
        ]),
      ],
      'client_phone_1' => 'required|string',
      'client_phone_2' => 'required|string',
      'email' => 'required|email',
      'address' => 'required|string',
      'state_id' => 'required|numeric|integer|exists:states,id',
      'observations' => 'required|string',
    ];
  }
}
