<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

  public function user() {
    return $this->hasOne('App\User', 'id');
  }

  public function state() {
    return $this->hasOne('App\State', 'id');
  }
}
