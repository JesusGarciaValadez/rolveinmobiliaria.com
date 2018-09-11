<?php

namespace App\Policies;

use App\User;
use App\Sale;

use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
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
    if (
      $user->isSuperAdmin() ||
      $user->isAdmin()
    )
    {
      return true;
    }
  }

  /**
   * Determine whether the user can view the sale.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function view(User $user, Sale $sale)
  {
    return $user->isSales();
  }

  /**
   * Determine whether the user can create sales.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return $user->isSales();
  }

  /**
   * Determine whether the user can update the sale.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function update(User $user, Sale $sale)
  {
    return (
      $user->isSales() &&
      $user->id === $sale->user->id
    );
  }

  /**
   * Determine whether the user can delete the sale.
   *
   * @param  \App\User  $user
   * @param  \App\Sale  $sale
   * @return mixed
   */
  public function delete(User $user, Sale $sale)
  {
    return (
      $user->isSales() &&
      $user->id === $sale->user->id
    );
  }
}
