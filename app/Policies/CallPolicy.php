<?php

namespace App\Policies;

use App\User;
use App\Call;
use Illuminate\Auth\Access\HandlesAuthorization;

class CallPolicy
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
   * Determine whether the user can view the call.
   *
   * @param  \App\User  $user
   * @param  \App\Call  $call
   * @return mixed
   */
  public function view(User $user, Call $call)
  {
    if (
      $user->isAssistant() ||
      $user->isSales()
    )
    {
      if ($call->id)
      {
        return $user->id === $call->user->id;
      }
      return false;
    }
    return false;
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
   * Determine whether the user can update the call.
   *
   * @param  \App\User  $user
   * @param  \App\Call  $call
   * @return mixed
   */
  public function update(User $user, Call $call)
  {
    if (
      $user->isAssistant() ||
      $user->isSales()
    )
    {
      return $user->id === $call->user->id;
    }
    return false;
  }

  /**
   * Determine whether the user can delete the call.
   *
   * @param  \App\User  $user
   * @param  \App\Call  $call
   * @return mixed
   */
  public function delete(User $user, Call $call)
  {
    if (
      $user->isAssistant() ||
      $user->isSales()
    )
    {
      return $user->id === $call->user->id;
    }
    return false;
  }
}
