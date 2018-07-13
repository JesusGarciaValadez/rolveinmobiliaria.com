<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
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
      $user->hasRole('Administrador') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can view the sale.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function view(User $user)
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
   * Determine whether the user can create sales.
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
   * Determine whether the user can update the sale.
   *
   * @param  \App\User  $user
   * @param  \App\Seller  $seller
   * @return mixed
   */
  public function update(User $user, Seller $seller)
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
   * Determine whether the user can delete the sale.
   *
   * @param  \App\User  $user
   * @param  \App\Seller  $seller
   * @return mixed
   */
  public function delete(User $user, Seller $seller)
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
