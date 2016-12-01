<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $contract_name;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $contract_name
     * @param $token
     */
    public function __construct($email, $contract_name, $token)
    {
        $this->email         = $email;
        $this->contract_name = $contract_name;
        $this->token         = $token;
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
