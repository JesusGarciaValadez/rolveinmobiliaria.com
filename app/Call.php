<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Call extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'type_of_operation',
    'client_phone_1',
    'client_phone_2',
    'email',
    'user_id',
    'observations',
    'address',
    'state_id',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'created_at', 'updated_at',
  ];

  /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
  protected $dates = [
    'created_at', 'updated_at',
  ];

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
