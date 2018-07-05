<?php

namespace App\Policies;

use App\User;
use App\SaleClosingContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class SaleClosingContractPolicy
{
  use HandlesAuthorization;

  public function before($user, $ability)
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
   * Determine whether the user can view the sale closing contract.
   *
   * @param  \App\User  $user
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return mixed
   */
  public function view(User $user, SaleClosingContract $saleClosingContract)
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
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return mixed
   */
  public function update(User $user, SaleClosingContract $saleClosingContract)
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
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return mixed
   */
  public function delete(User $user, SaleClosingContract $saleClosingContract)
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
