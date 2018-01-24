<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleRequest extends FormRequest
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
      "user_id" => 'string',
      // Documents
      "SD_predial" => 'nullable|string',
      "SD_light" => 'nullable|string',
      "SD_water" => 'nullable|string',
      "SD_deed" => 'nullable|string',
      "SD_generals_sheet" => 'nullable|string',
      "SD_INE" => 'nullable|string',
      "SD_CURP" => 'nullable|string',
      "SD_birth_certificate" => 'nullable|string',
      "SD_account_status" => 'nullable|string',
      "SD_email" => 'nullable|string',
      "SD_phone" => 'nullable|string',
      "SD_civil_status" => [
        Rule::in([
          'Soltero',
          'Casado'
        ]),
      ],
      // Closing contract
      "SCC_commercial_valuation" => 'sometimes|nullable|string',
      "SCC_exclusivity_contract" => 'sometimes|nullable|string',
      "SCC_publication" => 'sometimes|nullable|string',
      "SCC_data_sheet" => "sometimes|nullable|file",
      "SCC_data_sheet_exists" => "sometimes|nullable|string",
      "SCC_closing_contract_observations" => 'sometimes|nullable|string',
      // Contract
      "SC_general_buyer" => 'sometimes|nullable|string',
      "SC_purchase_agreements" => 'sometimes|nullable|string',
      "SC_tax_assessment" => 'sometimes|nullable|string',
      "SC_notary_checklist" => 'sometimes|nullable|string',
      "SC_notary_file" => 'sometimes|nullable|string',
      "SC_mortgage_credit" => Rule::in([
        'INFONAVIT',
        'FOVISSSTE',
        'COFINAVIT',
        'Bancario',
        'Aliados'
      ]),
      // Infonavit contract
      "IC_certified_birth_certificate" => 'sometimes|nullable|string',
      "IC_official_ID" => 'sometimes|nullable|string',
      "IC_curp" => 'sometimes|nullable|string',
      "IC_rfc" => 'sometimes|nullable|string',
      "IC_credit_simulator" => 'sometimes|nullable|string',
      "IC_credit_application" => 'sometimes|nullable|string',
      "IC_tax_valuation" => 'sometimes|nullable|string',
      "IC_bank_statement" => 'sometimes|nullable|string',
      "IC_workshop_knowing_how_to_decide" => 'sometimes|nullable|string',
      "IC_retention_sheet" => 'sometimes|nullable|string',
      "IC_credit_activation" => 'sometimes|nullable|string',
      "IC_credit_maturity" => 'sometimes|nullable|string',
      "IC_type" => Rule::in([
        'Individual',
        'Conyugal'
      ]),
      "IC_spouses_birth_certificate" => 'sometimes|nullable|string',
      "IC_official_identification_of_the_spouse" => 'sometimes|nullable|string',
      "IC_marriage_certificate" => 'sometimes|nullable|string',
      // Fovisste contract
      "FC_credit_simulator" => 'sometimes|nullable|string',
      "FC_curp" => 'sometimes|nullable|string',
      "FC_birth_certificate" => 'sometimes|nullable|string',
      "FC_bank_statement" => 'sometimes|nullable|string',
      "FC_single_key_housing_payment" => 'sometimes|nullable|string',
      "FC_general_buyers_and_sellers" => 'sometimes|nullable|string',
      "FC_education_course" => 'sometimes|nullable|string',
      "FC_last_pay_stub" => 'sometimes|nullable|string',
      // Cofinavit contract
      "CC_request_for_credit_inspection" => 'sometimes|nullable|string',
      "CC_birth_certificate" => 'sometimes|nullable|string',
      "CC_official_id" => 'sometimes|nullable|string',
      "CC_curp" => 'sometimes|nullable|string',
      "CC_rfc" => 'sometimes|nullable|string',
      "CC_bank_statement_seller" => 'sometimes|nullable|string',
      "CC_tax_valuation" => 'sometimes|nullable|string',
      "CC_scripture_copy" => 'sometimes|nullable|string',
      "CC_type" => Rule::in([
        'Individual',
        'Conyugal'
      ]),
      "CC_birth_certificate_of_the_spouse" => 'sometimes|nullable|string',
      "CC_official_identification_of_the_spouse" => 'sometimes|nullable|string',
      "CC_marriage_certificate" => 'sometimes|nullable|string',
      // Banking contract
      "SC_contract_with_the_broker" => 'sometimes|nullable|string',
      // Allies contract
      "SC_mortgage_broker" => 'sometimes|nullable|string',
      // Notary
      "SN_federal_entity" => Rule::in([
        'CDMX',
        'Edo. Mex.'
      ]),
      "SN_notaries_office" => 'sometimes|nullable|numeric',
      "SN_freedom_of_lien_certificate" => 'sometimes|nullable|string',
      "SN_zoning" => 'sometimes|nullable|string',
      "SN_water_no_due_constants" => 'sometimes|nullable|string',
      "SN_non_debit_proof_of_property" => 'sometimes|nullable|string',
      "SN_certificate_of_improvement" => 'sometimes|nullable|string',
      "SN_key_and_cadastral_value" => 'sometimes|nullable|string',
      // Signature
      "SS_writing_review" => 'sometimes|nullable|string',
      "SS_scheduled_date_of_writing_signature" => 'sometimes|nullable|string',
      "SS_writing_signature" => 'sometimes|nullable|string',
      "SS_scheduled_payment_date" => 'sometimes|nullable|string',
      "SS_payment_made" => 'sometimes|nullable|string'
    ];
  }
}
