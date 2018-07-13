<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   * @var string
   */
  protected $table = 'visits';

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = ['sale'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'SV_sales_id',
    'SV_subject',
    'SV_email',
    'SV_phone',
    'SV_observations',
    'SV_complete',
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

  public function sale()
  {
    return $this->hasMany('App\Sale', 'sales_id');
  }
}
