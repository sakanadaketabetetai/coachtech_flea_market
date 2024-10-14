<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $subjectText;
    public $content;
    public $user;

    public function __construct($subjectText, $content, $user)
    {
        $this->subjectText = $subjectText;
        $this->content = $content;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subjectText)
                    ->view('mail.mail_announcement')
                    ->with([
                        'content' => $this->content,
                        'userName' => $this->user->name
                    ]);
    }
}
