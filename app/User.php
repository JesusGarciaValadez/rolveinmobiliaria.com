<?php

namespace App;

use App\Call;
use App\Role;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use HasApiTokens;
  use Notifiable;
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password', 'role_id'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

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
    $role = Role::where('name', 'Super Administrador')->get()->first();

    return ($this->role_id === $role->id) ? true : false;
  }

  public function isAdmin()
  {
    $role = Role::where('name', 'Administrador')->get()->first();

    return ($this->role_id === $role->id) ? true : false;
  }

  public function isAssistant()
  {
    $role = Role::where('name', 'Asistente')->get()->first();

    return ($this->role_id === $role->id) ? true : false;
  }

  public function isSales()
  {
    $role = Role::where('name', 'Ventas')->get()->first();

    return ($this->role_id === $role->id) ? true : false;
  }

  public function isIntern()
  {
    $role = Role::where('name', 'Pasante')->get()->first();

    return ($this->role_id === $role->id) ? true : false;
  }

  public function isClient()
  {
    $role = Role::where('name', 'Cliente')->get()->first();

    return ($this->role_id === $role->id) ? true : false;
  }

  public function hasRole(String $role)
  {
    // \Debugbar::info($this->role->name);
    // if ($this->role->name === $role)
    // {
    //   \Debugbar::warning($this->role->name);
    //   \Debugbar::danger($this->role->name === $role);
    // }
    // else
    // {
    //   \Debugbar::info($role);
    // }
    return ($this->role->name === $role)
      ? true
      : false;
  }
}
