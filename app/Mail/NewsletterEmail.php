<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $published_contracts;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $published_contracts
     * @param $token
     */
    public function __construct($email, $published_contracts, $token)
    {
        $this->email               = $email;
        $this->published_contracts = $published_contracts;
        $this->token               = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.newsletter')
                    ->subject("Newsletter");
    }
}
