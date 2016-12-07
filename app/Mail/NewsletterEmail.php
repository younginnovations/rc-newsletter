<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $contract_names;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $contract_names
     * @param $token
     */
    public function __construct($email, $contract_names, $token)
    {
        $this->email          = $email;
        $this->contract_names = $contract_names;
        $this->token          = $token;
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
