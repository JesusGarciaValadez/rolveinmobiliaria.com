<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens;
  use Notifiable;
  use SoftDeletes;

  /**
   * The table associated with the model.
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = ['role'];

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
    return $this->hasOne(Role::class, 'id', 'role_id');
  }

  public function clients()
  {
    return $this->hasMany(Client::class, 'user_id', 'id');
  }

  public function messages()
  {
    return $this->hasMany(Message::class, 'user_id', 'id');
  }

  public function calls()
  {
    return $this->hasMany(Call::class, 'user_id', 'id');
  }

  public function sales()
  {
    return $this->hasMany(Sale::class, 'user_id', 'id');
  }

  public function isSuperAdmin()
  {
    $role = Role::where('name', \App\Enums\RoleType::SUPER_ADMIN)->get()->first();

    return $this->role_id === $role->id;
  }

  public function isAdmin()
  {
    $role = Role::where('name', \App\Enums\RoleType::ADMIN)->get()->first();

    return $this->role_id === $role->id;
  }

  public function isAssistant()
  {
    $role = Role::where('name', \App\Enums\RoleType::ASSISTANT)->get()->first();

    return $this->role_id === $role->id;
  }

  public function isSales()
  {
    $role = Role::where('name', \App\Enums\RoleType::SALES)->get()->first();

    return $this->role_id === $role->id;
  }

  public function isIntern()
  {
    $role = Role::where('name', \App\Enums\RoleType::INTERN)->get()->first();

    return $this->role_id === $role->id;
  }

  public function isClient()
  {
    $role = Role::where('name', \App\Enums\RoleType::CLIENT)->get()->first();

    return $this->role_id === $role->id;
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
    return $this->role->name === $role;
  }
}
