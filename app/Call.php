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
  protected $fillable = [
    'expedient',
    'type_of_operation',
    'client',
    'client_phone_1',
    'client_phone_2',
    'email',
    'address',
    'state_id',
    'observations',
    'user_id',
    'status',
    'priority',
  ];

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
  protected $dateFormat = 'Y-m-d H:i:s';

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function client()
  {
    return $this->belongsTo('App\Client');
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
