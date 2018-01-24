<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleContract extends Model
{
  use SoftDeletes;

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = [
    'infonavit_contract',
    'fovissste_contract',
    'cofinavit_contract'
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'infonavit_contracts_id',
    'fovissste_contracts_id',
    'cofinavit_contracts_id',
    'mortgage_credit',
    'mortgage_broker',
    'contract_with_the_broker',
    'general_buyer',
    'purchase_agreements',
    'tax_assessment',
    'notary_checklist',
    'notary_file',
    'complete',
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

  public function infonavit_contract()
  {
    return $this->belongsTo('App\InfonavitContract', 'id');
  }

  public function fovissste_contract()
  {
    return $this->belongsTo('App\FovisssteContract', 'id');
  }

  public function cofinavit_contract()
  {
    return $this->belongsTo('App\CofinavitContract', 'id');
  }
}
