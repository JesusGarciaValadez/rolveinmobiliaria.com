<?php

declare(strict_types=1);

namespace App\Policies;

use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
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
     * Determine whether the user can view the message.
     */
    public function view(User $user, Sale $sale)
    {
        return
      $user->isAssistant() ||
      $user->isSales();
    }

    /**
     * Determine whether the user can create messages.
     */
    public function create(User $user)
    {
        return
      $user->isAssistant() ||
      $user->isSales();
    }

    /**
     * Determine whether the user can update the message.
     */
    public function update(User $user, Message $message)
    {
        if (
      $user->isAssistant() ||
      $user->isSales()
    ) {
            return $user->id === $message->user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the message.
     */
    public function delete(User $user, Message $message)
    {
        if (
      $user->isAssistant() ||
      $user->isSales()
    ) {
            return $user->id === $message->user->id;
        }

        return false;
    }
}
