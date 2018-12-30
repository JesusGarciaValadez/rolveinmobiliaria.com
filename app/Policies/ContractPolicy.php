<?php

declare(strict_types=1);

namespace App\Policies;

use App\Sale;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
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
     * Determine whether the user can view the sale contract.
     */
    public function view(User $user, Sale $sale)
    {
        if ($user->isSales()) {
            return $user->id === $sale->user->id;
        }
    }

    /**
     * Determine whether the user can create sale contracts.
     */
    public function create(User $user)
    {
        return $user->isSales();
    }

    /**
     * Determine whether the user can update the sale contract.
     */
    public function update(User $user, Sale $sale)
    {
        if ($user->isSales()) {
            return $user->id === $sale->user->id;
        }
    }

    /**
     * Determine whether the user can delete the sale contract.
     */
    public function delete(User $user, Sale $sale)
    {
        if ($user->isSales()) {
            return $user->id === $sale->user->id;
        }
    }
}
