<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use App\Visit;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sale log.
     */
    public function view(User $user, Visit $visit): void
    {
    }

    /**
     * Determine whether the user can create sale logs.
     */
    public function create(User $user): void
    {
    }

    /**
     * Determine whether the user can update the sale log.
     */
    public function update(User $user, Visit $visit): void
    {
    }

    /**
     * Determine whether the user can delete the sale log.
     */
    public function delete(User $user, Visit $visit): void
    {
    }
}
