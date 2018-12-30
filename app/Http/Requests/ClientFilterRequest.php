<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFilterRequest extends FormRequest
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
            'filter_by' => 'required|string',
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'phone_1' => 'sometimes|required|string',
            'phone_2' => 'sometimes|required|string',
            'business' => 'sometimes|required|string',
            'email_1' => 'sometimes|required|string|email',
            'email_2' => 'sometimes|required|string|email',
            'reference' => 'sometimes|required|string',
        ];
    }
}
