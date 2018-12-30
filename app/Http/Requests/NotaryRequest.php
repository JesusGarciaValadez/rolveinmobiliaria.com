<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaryRequest extends FormRequest
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
            'SN_federal_entity' => 'nullable|string',
            'SN_notaries_office' => 'nullable|string',
            'SN_string_freedom_of_lien_certificate' => 'nullable|string',
            'SN_hour_freedom_of_lien_certificate' => 'nullable|string',
            'SN_observations_freedom_of_lien_certificate' => 'nullable|string',
            'SN_beginning_of_the_certificate_of_freedom_of_assessment' => 'nullable|string',
            'SN_zoning' => 'nullable|string',
            'SN_water_no_due_constants' => 'nullable|string',
            'SN_non_debit_proof_of_property' => 'nullable|string',
            'SN_certificate_of_improvement' => 'nullable|string',
            'SN_key_and_cadastral_value' => 'nullable|string',
            'SN_seller_documents' => 'nullable|string',
            'SN_buyer_documents' => 'nullable|string',
            'SN_activation_documents_for_the_mortgage_loan' => 'nullable|string',
        ];
    }
}
