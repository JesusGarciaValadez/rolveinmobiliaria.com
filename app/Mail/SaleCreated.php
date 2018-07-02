<?php

namespace App\Mail;

use App\Sale;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaleCreated extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * The message instance.
   *
   * @var Message
   */
  public $saleCreated;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Sale $sale)
  {
    $this->saleCreated = $sale;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('mails.sale.created')
                ->text('mails.sale.created_plain')
                ->subject('Nueva compraventa creada');
  }
}
