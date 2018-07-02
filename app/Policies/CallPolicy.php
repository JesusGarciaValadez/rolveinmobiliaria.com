<?php

namespace App\Policies;

use App\User;
use App\Call;
use Illuminate\Auth\Access\HandlesAuthorization;

class CallPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  public function before($user, $ability)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can view the call.
   *
   * @param  \App\User  $user
   * @param  \App\Call  $call
   * @return mixed
   */
  public function view(User $user)
  {
    return (
      $user->hasRole('Asistente') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can create calls.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return (
      $user->hasRole('Asistente') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can update the call.
   *
   * @param  \App\User  $user
   * @param  \App\Call  $call
   * @return mixed
   */
  public function update(User $user, $call)
  {
    if (
      $user->hasRole('Asistente') ||
      $user->hasRole('Ventas')
    )
    {
      if (Auth::id() == $call->user_id) {
        return true;
      }
    }
    return false;
  }

  /**
   * Determine whether the user can delete the call.
   *
   * @param  \App\User  $user
   * @param  \App\Call  $call
   * @return mixed
   */
  public function delete(User $user, $call)
  {
    if (
      $user->hasRole('Asistente') ||
      $user->hasRole('Ventas')
    )
    {
      if (Auth::id() == $call->user_id) {
        return true;
      }
    }
    return false;
  }
}
