<?php

namespace App\Policies;

use App\User;
use App\Visit;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sale log.
     *
     * @param  \App\User  $user
     * @param  \App\Visit  $visit
     * @return mixed
     */
    public function view(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can create sale logs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the sale log.
     *
     * @param  \App\User  $user
     * @param  \App\Visit  $visit
     * @return mixed
     */
    public function update(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can delete the sale log.
     *
     * @param  \App\User  $user
     * @param  \App\Visit  $visit
     * @return mixed
     */
    public function delete(User $user, Visit $visit)
    {
        //
    }
}
