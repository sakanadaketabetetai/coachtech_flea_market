<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $user;
    public $item;

    public function __construct($order, $user, $item)
    {
        $this->order = $order;
        $this->user = $user;
        $this->item = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail_purchase')
                    ->with([
                        'order' => $this->order,
                        'user' => $this->user,
                        'item' => $this->item
                    ]);
    }
}
