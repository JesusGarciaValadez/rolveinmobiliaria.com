<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
  use HandlesAuthorization;

  public function before(User $user)
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
   * @return mixed
   */
  public function view(User $user)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador')
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
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can update the call.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function update(User $user)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can delete the call.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function delete(User $user)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador')
    )
      ? true
      : false;
  }
}
