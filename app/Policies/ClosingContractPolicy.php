<?php

namespace App\Policies;

use App\User;
use App\Sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClosingContractPolicy
{
  use HandlesAuthorization;

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
   * Determine whether the user can view the sale closing contract.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function view(User $user, Sale $sale)
  {
    return (
      $user->hasRole('Ventas') &&
      $user->id === $sale->user->id
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can create sale closing contracts.
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
   * Determine whether the user can update the sale closing contract.
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
   * Determine whether the user can delete the sale closing contract.
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
