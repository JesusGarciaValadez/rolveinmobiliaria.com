<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class ClosingContract extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   * @var string
   */
  protected $table = 'closing_contracts';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'SCC_exclusivity_contract',
    'SCC_commercial_valuation',
    'SCC_publication',
    'SCC_data_sheet',
    'SCC_closing_contract_observations',
    'SCC_complete',
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
    return $this->belongsTo(Sale::class, 'closing_contracts_id');
  }

  public function setSCCExclusivityContractAttribute($value)
  {
    $this->attributes['SCC_exclusivity_contract'] = ($value)
      ? Carbon::parse($value)->format('U')
      : null;
  }

  public function setSCCCommercialValuationAttribute($value)
  {
    $this->attributes['SCC_commercial_valuation'] = ($value)
      ? Carbon::parse($value)->format('U')
      : null;
  }

  public function setSCCPublicationAttribute($value)
  {
    $this->attributes['SCC_publication'] = ($value)
      ? Carbon::parse($value)->format('U')
      : null;
  }

  public function getSCCExclusivityContractAttribute($value)
  {
    return Carbon::createFromTimestamp($value)->toDateString();
  }

  public function getSCCCommercialValuationAttribute($value)
  {
    return Carbon::createFromTimestamp($value)->toDateString();
  }

  public function getSCCPublicationAttribute($value)
  {
    return Carbon::createFromTimestamp($value)->toDateString();
  }
}
