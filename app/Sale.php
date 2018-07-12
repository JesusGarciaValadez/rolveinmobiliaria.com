<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   * @var string
   */
  protected $table = 'sales';

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = [
    'user',
    'internal_expedient',
    'seller',
    'closing_contract',
    'contract',
    'notary',
    'signature'
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'internal_expedients_id',
    'sale_sellers_id',
    'sale_closing_contracts_id',
    'sale_logs_id',
    'sale_contracts_id',
    'sale_notaries_id',
    'sale_signatures_id',
    'user_id',
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
  protected $dateFormat = 'Y-m-d h:i:s';

  public function internal_expedient()
  {
    return $this->hasOne(InternalExpedient::class, 'id', 'internal_expedients_id');
  }

  public function seller()
  {
    return $this->hasOne(SaleSeller::class, 'id', 'sale_sellers_id');
  }

  public function closing_contract()
  {
    return $this->hasOne(SaleClosingContract::class, 'id', 'sale_closing_contracts_id');
  }

  public function contract()
  {
    return $this->hasOne(SaleContract::class, 'id', 'sale_contracts_id');
  }

  public function notary()
  {
    return $this->hasOne(SaleNotary::class, 'id', 'sale_notaries_id');
  }

  public function signature()
  {
    return $this->hasOne(SaleSignature::class, 'id', 'sale_signatures_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function getCreatedAttribute()
  {
    $date = $this->created_at->format('Y-M-d h:i a');

    return $date;
  }

  public function getUpdatedAttribute()
  {
    $date = (isset($this->updated_at))
              ? $this->updated_at->format('Y-M-d h:i a')
              : null;

    return $date;
  }

  public function getHourAttribute()
  {
    $date = $this->created_at->format('h:i');

    return $date.' hrs';
  }
}
