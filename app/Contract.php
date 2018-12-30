<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    /**
     * The attributes that represents the models who has relationship with.
     *
     * @var array
     */
    protected $with = [
        'infonavit_contract',
        'fovissste_contract',
        'cofinavit_contract',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SC_infonavit_contracts_id',
        'SC_fovissste_contracts_id',
        'SC_cofinavit_contracts_id',
        'SC_mortgage_broker',
        'SC_contract_with_the_broker',
        'SC_mortgage_credit',
        'SC_general_buyer',
        'SC_purchase_agreements',
        'SC_tax_assessment',
        'SC_notary_checklist',
        'SC_notary_file',
        'SC_complete',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d h:i:s';

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'contracts_id');
    }

    public function infonavit_contract()
    {
        return $this->belongsTo(InfonavitContract::class, 'SC_infonavit_contracts_id');
    }

    public function fovissste_contract()
    {
        return $this->belongsTo(FovisssteContract::class, 'SC_fovissste_contracts_id');
    }

    public function cofinavit_contract()
    {
        return $this->belongsTo(CofinavitContract::class, 'SC_cofinavit_contracts_id');
    }
}
