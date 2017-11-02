<?php

namespace App\Policies;

use App\User;
use App\Sale;

use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
      return (
        $user->isSuperAdmin() ||
        $user->isAdmin() ||
        $user->isAssistant() ||
        $user->isSales()
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
        $user->isSuperAdmin() ||
        $user->isAdmin() ||
        $user->isAssistant() ||
        $user->isSales()
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
        $user->isSuperAdmin() ||
        $user->isAdmin() ||
        $user->isAssistant() ||
        $user->isSales()
      )
        ? true
        : false;
    }

    /**
     * Determine whether the user can update the sale.
     *
     * @param  \App\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function update(User $user, $sale)
    {
      return (
        $user->isSuperAdmin() ||
        $user->isAdmin() ||
        $user->isAssistant() ||
        $user->isSales()
      )
        ? true
        : false;
    }

    /**
     * Determine whether the user can delete the sale.
     *
     * @param  \App\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function delete(User $user, $sale)
    {
      return (
        $user->isSuperAdmin() ||
        $user->isAdmin() ||
        $user->isAssistant() ||
        $user->isSales()
      )
        ? true
        : false;
    }
}
