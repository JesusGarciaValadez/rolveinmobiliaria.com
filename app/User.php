<?php

declare(strict_types=1);

namespace App;

use App\Enums\RoleType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that represents the models who has relationship with.
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

    public function isSuperAdmin(): bool
    {
        $role = Role::where('name', RoleType::SUPER_ADMIN)->get()->first();

        return $role ? $this->role_id === $role->id : false;
    }

    public function isAdmin(): bool
    {
        $role = Role::where('name', RoleType::ADMIN)->get()->first();

        return $role ? $this->role_id === $role->id : false;
    }

    public function isAssistant(): bool
    {
        $role = Role::where('name', RoleType::ASSISTANT)->get()->first();

        return $role ? $this->role_id === $role->id : false;
    }

    public function isSales(): bool
    {
        $role = Role::where('name', RoleType::SALES)->get()->first();

        return $role ? $this->role_id === $role->id : false;
    }

    public function isIntern(): bool
    {
        $role = Role::where('name', RoleType::INTERN)->get()->first();

        return $role ? $this->role_id === $role->id : false;
    }

    public function isClient(): bool
    {
        $role = Role::where('name', RoleType::CLIENT)->get()->first();

        return $role ? $this->role_id === $role->id : false;
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
