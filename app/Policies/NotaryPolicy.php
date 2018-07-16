<?php

namespace App\Policies;

use App\User;
use App\Sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotaryPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the sale notary.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function view(User $user, Sale $sale)
  {
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador')
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
    return ($user->hasRole('Ventas'))
      ? true
      : false;
  }

  /**
   * Determine whether the user can update the sale notary.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function update(User $user, Sale $sale)
  {
    return (
      $user->hasRole('Ventas') &&
      $user->id === $sale->user->id
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can delete the sale notary.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function delete(User $user, Sale $sale)
  {
    return (
      $user->hasRole('Ventas') &&
      $user->id === $sale->user->id
    )
      ? true
      : false;
  }
}
