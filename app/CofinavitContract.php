<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CofinavitContract extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CC_type',
        'CC_request_for_credit_inspection',
        'CC_birth_certificate',
        'CC_official_id',
        'CC_curp',
        'CC_rfc',
        'CC_bank_statement_seller',
        'CC_tax_valuation',
        'CC_scripture_copy',
        'CC_birth_certificate_of_the_spouse',
        'CC_official_identification_of_the_spouse',
        'CC_marriage_certificate',
        'CC_complete',
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
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d h:i:s';
}
