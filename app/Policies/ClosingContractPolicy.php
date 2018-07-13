<?php

namespace App\Policies;

use App\User;
use App\ClosingContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClosingContractPolicy
{
  use HandlesAuthorization;

  public function before($user, $ability)
  {
    \Debugbar::info((
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false);
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can view the sale closing contract.
   *
   * @param  \App\User  $user
   * @param  \App\ClosingContract  $closingContract
   * @return mixed
   */
  public function view(User $user, ClosingContract $closingContract)
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
   * Determine whether the user can create sale closing contracts.
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
   * Determine whether the user can update the sale closing contract.
   *
   * @param  \App\User  $user
   * @param  \App\ClosingContract  $closingContract
   * @return mixed
   */
  public function update(User $user, ClosingContract $closingContract)
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
   * Determine whether the user can delete the sale closing contract.
   *
   * @param  \App\User  $user
   * @param  \App\ClosingContract  $closingContract
   * @return mixed
   */
  public function delete(User $user, ClosingContract $closingContract)
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
