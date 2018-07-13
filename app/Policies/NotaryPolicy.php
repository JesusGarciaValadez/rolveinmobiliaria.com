<?php

namespace App\Policies;

use App\User;
use App\Notary;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotaryPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the sale notary.
   *
   * @param  \App\User  $user
   * @param  \App\Notary  $notary
   * @return mixed
   */
  public function view(User $user, Notary $notary)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can create sale notaries.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can update the sale notary.
   *
   * @param  \App\User  $user
   * @param  \App\Notary  $notary
   * @return mixed
   */
  public function update(User $user, Notary $notary)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can delete the sale notary.
   *
   * @param  \App\User  $user
   * @param  \App\Notary  $notary
   * @return mixed
   */
  public function delete(User $user, Notary $notary)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }
}
