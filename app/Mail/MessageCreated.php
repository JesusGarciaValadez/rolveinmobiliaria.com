<?php

namespace App\Mail;

use App\Message;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageCreated extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * The message instance.
   *
   * @var Message
   */
  public $messageCreated;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Message $message)
  {
    $this->messageCreated = $message;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('mails.message.created')
                ->text('mails.message.created_plain')
                ->subject('Nuevo recado creado');
  }
}
