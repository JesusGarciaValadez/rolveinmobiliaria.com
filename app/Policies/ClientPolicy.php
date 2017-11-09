<?php

namespace App\Policies;

use App\User;
use App\Client;

use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
      return (
        $user->hasRole('Super Administrador') ||
        $user->hasRole('Administrador') |
        $user->hasRole('Ventas')
      )
        ? true
        : false;
    }

    /**
     * Determine whether the user can view the call.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
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
     * Determine whether the user can create calls.
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
     * Determine whether the user can update the call.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function update(User $user, $client)
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
     * Determine whether the user can delete the call.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function delete(User $user, $client)
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
