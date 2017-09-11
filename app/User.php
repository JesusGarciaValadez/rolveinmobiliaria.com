<?php

namespace App;

use App\Call;
use App\Role;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'role_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
  protected $dates = [
    'created_at', 'updated_at',
  ];

  public function role()
  {
    return $this->belongsTo('App\Role');
  }

  public function call()
  {
    return $this->belongsToMany('App\Call');
  }

  public function isSuperAdmin()
  {
    return ($this->role_id === 1) ? true : false;
  }

  public function isAdmin()
  {
    return ($this->role_id === 2) ? true : false;
  }

  public function isAssistant()
  {
    return ($this->role_id === 3) ? true : false;
  }

  public function isSales()
  {
    return ($this->role_id === 4) ? true : false;
  }

  public function isIntern()
  {
    return ($this->role_id === 5) ? true : false;
  }

  public function isClient()
  {
    return ($this->role_id === 6) ? true : false;
  }

  public function hasRole(String $role)
  {
    return ($this->role->name === $role)
      ? true
      : false;
  }
}
