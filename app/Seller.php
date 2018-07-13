<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   * @var string
   */
  protected $table = 'sellers';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'SD_deed',
    'SD_water',
    'SD_predial',
    'SD_light',
    'SD_birth_certificate',
    'SD_ID',
    'SD_CURP',
    'SD_RFC',
    'SD_account_status',
    'SD_email',
    'SD_phone',
    'SD_civil_status',
    'SD_complete',
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

  public function sale()
  {
    return $this->belongsTo(Sale::class, 'sellers_id');
  }
}
