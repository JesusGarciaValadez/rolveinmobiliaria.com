<?php

declare(strict_types=1);

namespace App\Policies;

use App\Sale;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotaryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function before($user, $ability)
    {
        if (
      $user->isSuperAdmin() ||
      $user->isAdmin()
    ) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the sale notary.
     */
    public function view(User $user, Sale $sale)
    {
        return
      $user->isSuperAdmin() ||
      $user->isAdmin();
    }

    /**
     * Determine whether the user can create sale notaries.
     */
    public function create(User $user)
    {
        return $user->isSales();
    }

    /**
     * Determine whether the user can update the sale notary.
     */
    public function update(User $user, Sale $sale)
    {
        return
      $user->isSales() &&
      $user->id === $sale->user->id;
    }

    /**
     * Determine whether the user can delete the sale notary.
     */
    public function delete(User $user, Sale $sale)
    {
        return
      $user->isSales() &&
      $user->id === $sale->user->id;
    }
}
