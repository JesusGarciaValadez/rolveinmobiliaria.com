<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalExpedient extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   * @var string
   */
  protected $table = 'internal_expedients';

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = ['client', 'user'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'client_id',
    'user_id',
    'expedient_key',
    'expedient_number',
    'expedient_year'
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
  protected $dateFormat = 'Y-m-d h:i:s';

  public function client()
  {
    return $this->belongsTo(Client::class, 'client_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function calls()
  {
    return $this->belongsToMany(Call::class, 'internal_expedients_id', 'id');
  }

  public function sale()
  {
    return $this->belongsTo(Sale::class, 'internal_expedients_id', 'id');
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

  public function getExpedientAttribute()
  {
    return $this->expedient_key . '/' . $this->expedient_number . '/' . $this->expedient_year;
  }
}
