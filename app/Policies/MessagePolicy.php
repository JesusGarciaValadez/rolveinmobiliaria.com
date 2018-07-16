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
    return (
      $user->hasRole('Super Administrador') ||
      $user->hasRole('Administrador')
    )
      ? true
      : false;
  }

  /**
   * Determine whether the user can view the message.
   *
   * @param  \App\User  $user
   * @param  \App\Message  $message
   * @return mixed
   */
  public function view(User $user, Message $message)
  {
    return (
      ($user->hasRole('Asistente') ||
       $user->hasRole('Ventas')) &&
      $user->id === $message->user->id
    )
      ? true
      : false;
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
      $user->hasRole('Asistente') ||
      $user->hasRole('Ventas')
    )
      ? true
      : false;
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
    return (
      ($user->hasRole('Asistente') ||
       $user->hasRole('Ventas')) &&
      $user->id === $message->user->id
    )
      ? true
      : false;
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
    return (
      ($user->hasRole('Asistente') ||
       $user->hasRole('Ventas')) &&
      $user->id === $message->user->id
    )
      ? true
      : false;
  }
}
