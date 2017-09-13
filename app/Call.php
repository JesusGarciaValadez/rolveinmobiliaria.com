<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Call extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [ 'type_of_operation', 'client_phone_1',
  'client_phone_2', 'email', 'address', 'state_id', 'observations', 'user_id'];

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

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function state()
  {
    return $this->belongsTo('App\State');
  }

  public function getHourAttribute()
  {
    $date = Carbon::parse($this->created_at);
    return $date->hour.':'.$date->minute;
  }
}
