<?php

namespace App\Policies;

use App\User;
use App\Call;

use Illuminate\Auth\Access\HandlesAuthorization;

class CallPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
      return (
        $user->hasRole('Super Administrador') ||
        $user->hasRole('Administrador') ||
        $user->hasRole('Asistente')
      )
        ? true
        : false;
    }

    /**
     * Determine whether the user can view the call.
     *
     * @param  \App\User  $user
     * @param  \App\Call  $call
     * @return mixed
     */
    public function view(User $user)
    {
      return (
        $user->hasRole('Super Administrador') ||
        $user->hasRole('Administrador') ||
        $user->hasRole('Asistente')
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
        $user->hasRole('Asistente')
      )
        ? true
        : false;
    }

    /**
     * Determine whether the user can update the call.
     *
     * @param  \App\User  $user
     * @param  \App\Call  $call
     * @return mixed
     */
    public function update(User $user, $call)
    {
      return (
        $user->hasRole('Super Administrador') ||
        $user->hasRole('Administrador') ||
        $user->hasRole('Asistente')
      )
        ? true
        : false;
    }

    /**
     * Determine whether the user can delete the call.
     *
     * @param  \App\User  $user
     * @param  \App\Call  $call
     * @return mixed
     */
    public function delete(User $user, $call)
    {
      return (
        $user->hasRole('Super Administrador') ||
        $user->hasRole('Administrador') ||
        $user->hasRole('Asistente')
      )
        ? true
        : false;
    }
}
