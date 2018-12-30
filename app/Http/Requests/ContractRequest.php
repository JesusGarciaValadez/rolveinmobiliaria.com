<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContractRequest extends FormRequest
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
            'SC_infonavit_contracts_id' => 'nullable|string',
            'SC_fovissste_contracts_id' => 'nullable|string',
            'SC_cofinavit_contracts_id' => 'nullable|string',
            'SC_mortgage_broker' => 'nullable|string',
            'SC_contract_with_the_broker' => 'nullable|string',
            'SC_mortgage_credit' => [
                'string',
                Rule::in([
                    'INFONAVIT',
                    'FOVISSSTE',
                    'COFINAVIT',
                    'Bancario',
                    'Aliados',
                ]),
            ],
            'SC_general_buyer' => 'nullable|string',
            'SC_purchase_agreements' => 'nullable|string',
            'SC_tax_assessment' => 'nullable|string',
            'SC_notary_checklist' => 'nullable|string',
            'SC_notary_file' => 'nullable|string',
            'SC_complete' => 'nullable|string',
        ];
    }
}
