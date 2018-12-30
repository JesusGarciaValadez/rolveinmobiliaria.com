<?php

declare(strict_types=1);

namespace App\Policies;

use App\Client;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
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
     * Determine whether the user can view a client.
     */
    public function view(User $user, Client $client)
    {
        return
      $user->isAssistant() ||
      $user->isSales();
    }

    /**
     * Determine whether the user can create calls.
     */
    public function create(User $user)
    {
        return
      $user->isAssistant() ||
      $user->isSales();
    }

    /**
     * Determine whether the user can update a client.
     *
     * @param  \App\Client  $client
     */
    public function update(User $user, $client)
    {
        return
      $user->isAssistant() ||
      $user->isSales();
    }

    /**
     * Determine whether the user can delete a client.
     *
     * @param  \App\Client  $client
     */
    public function delete(User $user, $client)
    {
        return
      $user->isAssistant() ||
      $user->isSales();
    }
}
