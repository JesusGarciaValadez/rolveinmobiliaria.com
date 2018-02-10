<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'messages';

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = true;

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = ['user'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'name',
    'observations',
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

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'created' => 'date:Y-M-d',
    'updated' => 'date:Y-M-d',
  ];

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
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
