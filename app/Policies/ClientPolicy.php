<?php

namespace App\Policies;

use App\User;
use App\Client;

use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
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
   * Determine whether the user can view a client.
   *
   * @param  \App\User  $user
   * @param  \App\Client  $client
   * @return mixed
   */
  public function view(User $user, Client $client)
  {
    return (
      $user->isAssistant() ||
      $user->isSales()
    );
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
      $user->isAssistant() ||
      $user->isSales()
    );
  }

  /**
   * Determine whether the user can update a client.
   *
   * @param  \App\User  $user
   * @param  \App\Client  $client
   * @return mixed
   */
  public function update(User $user, $client)
  {
    return (
      $user->isAssistant() ||
      $user->isSales()
    );
  }

  /**
   * Determine whether the user can delete a client.
   *
   * @param  \App\User  $user
   * @param  \App\Client  $client
   * @return mixed
   */
  public function delete(User $user, $client)
  {
    return (
      $user->isAssistant() ||
      $user->isSales()
    );
  }
}
