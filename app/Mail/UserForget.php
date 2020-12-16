<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserForget extends Mailable
{
    use Queueable, SerializesModels;
    public $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $pass)
    {
        $this->user = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.forget');
    }
}
