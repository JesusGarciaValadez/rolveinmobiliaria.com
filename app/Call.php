<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Call extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   * @var string
   */
  protected $table = 'calls';

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = ['internal_expedient', 'user', 'state'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'type_of_operation',
    'internal_expedient_id',
    'address',
    'state_id',
    'observations',
    'status',
    'priority',
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
  protected $dateFormat = 'Y-m-d H:i:s';

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function state()
  {
    return $this->hasOne(State::class, 'id', 'state_id');
  }

  public function internal_expedient()
  {
    return $this->hasOne(InternalExpedient::class, 'id', 'internal_expedient_id');
  }

  public function getCreatedAttribute()
  {
    $date = $this->created_at->format('Y-M-d h:i a');

    return $date;
  }

  public function getUpdatedAttribute()
  {
    $date = (isset($this->updated_at))
              ? $this->updated_at->format('Y-M-d h:i a')
              : null;

    return $date;
  }

  public function getHourAttribute()
  {
    $date = $this->created_at->format('h:i');

    return $date.' hrs';
  }
}
