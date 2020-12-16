<?php

namespace App\Mail;

use App\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $service;
    public $req;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Service $service,$req)
    {
        $this->service = $service;
        $this->req = $req;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.service');
    }
}
