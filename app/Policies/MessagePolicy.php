<?php

namespace App\Policies;

use App\User;
use App\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
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
   * Determine whether the user can view the message.
   *
   * @param  \App\User  $user
   * @param  \App\Message  $message
   * @return mixed
   */
  public function view(User $user, Sale $sale)
  {
    return (
      $user->isAssistant() ||
      $user->isSales()
    );
  }

  /**
   * Determine whether the user can create messages.
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
   * Determine whether the user can update the message.
   *
   * @param  \App\User  $user
   * @param  \App\Message  $message
   * @return mixed
   */
  public function update(User $user, Message $message)
  {
    if (
      $user->isAssistant() ||
      $user->isSales()
    )
    {
      return $user->id === $message->user->id;
    }
    return false;
  }

  /**
   * Determine whether the user can delete the message.
   *
   * @param  \App\User  $user
   * @param  \App\Message  $message
   * @return mixed
   */
  public function delete(User $user, Message $message)
  {
    if (
      $user->isAssistant() ||
      $user->isSales()
    )
    {
      return $user->id === $message->user->id;
    }
    return false;
  }
}
