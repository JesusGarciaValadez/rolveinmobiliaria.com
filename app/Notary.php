<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notary extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SN_federal_entity',
        'SN_notaries_office',
        'SN_date_freedom_of_lien_certificate',
        'SN_observations_freedom_of_lien_certificate',
        'SN_beginning_of_the_certificate_of_freedom_of_assessment',
        'SN_zoning',
        'SN_water_no_due_constants',
        'SN_non_debit_proof_of_property',
        'SN_certificate_of_improvement',
        'SN_key_and_cadastral_value',
        'SN_seller_documents',
        'SN_buyer_documents',
        'SN_activation_documents_for_the_mortgage_loan',
        'SN_complete',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'notaries_id');
    }

    /**
     * Accessors.
     */
    public function getSNDateFreedomOfLienCertificateAttribute($value)
    {
        return Carbon::createFromTimestamp($value)->toDateString();
    }

    public function getSNBeginningOfTheCertificateOfFreedomOfAssessmentAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNZoningAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNWaterNoDueConstantsAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNNonDebitProofOfPropertyAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNCertificateOfImprovementAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNKeyAndCadastralValueAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNSellerDocumentsAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNBuyerDocumentsAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }

    public function getSNActivationDocumentsForTheMortgageLoanAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }
}
