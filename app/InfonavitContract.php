<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfonavitContract extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'IC_type',
    'IC_certified_birth_certificate',
    'IC_official_ID',
    'IC_curp',
    'IC_rfc',
    'IC_spouses_birth_certificate',
    'IC_official_identification_of_the_spouse',
    'IC_marriage_certificate',
    'IC_credit_simulator',
    'IC_credit_application',
    'IC_tax_valuation',
    'IC_bank_statement',
    'IC_workshop_knowing_how_to_decide',
    'IC_retention_sheet',
    'IC_credit_activation',
    'IC_credit_maturity',
    'IC_complete',
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

  public function contract ()
  {
    return $this->hasOne('App\SaleContract', 'sale_contracts_id');
  }
}
