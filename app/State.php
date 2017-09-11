<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
  ];

  /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
  protected $dates = [
    'created_at',
    'updated_at',
  ];

  public function call()
  {
    return $this->hasMany('App\Call', 'id');
  }
}
