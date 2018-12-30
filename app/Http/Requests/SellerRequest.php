<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerRequest extends FormRequest
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
            'internal_expedient_id' => 'required|string',
            // Documents
            'SD_deed' => 'nullable|string',
            'SD_water' => 'nullable|string',
            'SD_predial' => 'nullable|string',
            'SD_light' => 'nullable|string',
            'SD_birth_certificate' => 'nullable|string',
            'SD_ID' => 'nullable|string',
            'SD_CURP' => 'nullable|string',
            'SD_RFC' => 'nullable|string',
            'SD_account_status' => 'nullable|string',
            'SD_email' => 'nullable|string',
            'SD_phone' => 'nullable|string',
            'SD_civil_status' => [
                'string',
                Rule::in([
                    'Soltero',
                    'Casado',
                ]),
            ],
            'SD_complete' => 'nullable|string',
        ];
    }
}
