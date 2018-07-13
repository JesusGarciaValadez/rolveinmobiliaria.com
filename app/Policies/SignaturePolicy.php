<?php

namespace App\Policies;

use App\User;
use App\Signature;
use Illuminate\Auth\Access\HandlesAuthorization;

class SignaturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sale signature.
     *
     * @param  \App\User  $user
     * @param  \App\Signature  $signature
     * @return mixed
     */
    public function view(User $user, Signature $signature)
    {
        //
    }

    /**
     * Determine whether the user can create sale signatures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the sale signature.
     *
     * @param  \App\User  $user
     * @param  \App\Signature  $signature
     * @return mixed
     */
    public function update(User $user, Signature $signature)
    {
        //
    }

    /**
     * Determine whether the user can delete the sale signature.
     *
     * @param  \App\User  $user
     * @param  \App\Signature  $signature
     * @return mixed
     */
    public function delete(User $user, Signature $signature)
    {
        //
    }
}
