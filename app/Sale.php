<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'internal_expedients_id',
    'sale_documents_id',
    'sale_closing_contracts_id',
    'sale_logs_id',
    'sale_contracts_id',
    'sale_notaries_id',
    'sale_signatures_id',
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

  public function internalExpedient()
  {
    return $this->belongsTo('App\InternalExpedient');
  }

  public function document()
  {
    return $this->belongsTo('App\SaleDocument');
  }

  public function closingContract()
  {
    return $this->belongsTo('App\SaleClosingContracts');
  }

  public function log()
  {
    return $this->belongsTo('App\SaleLogs');
  }

  public function contract()
  {
    return $this->belongsTo('App\SaleContract');
  }

  public function notary()
  {
    return $this->belongsTo('App\SaleNotary');
  }

  public function signature()
  {
    return $this->belongsTo('App\SaleSignature');
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
