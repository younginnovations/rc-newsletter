<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class NewsletterEmail
 * @package App\Mail
 */
class NewsletterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *  Email
     */
    public $email;

    /**
     * Published contracts
     */
    public $published_contracts;

    /**
     * Token
     */
    public $token;

    /**
     * Config
     */
    public $config;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $published_contracts
     * @param $token
     * @param $config
     */
    public function __construct($email, $published_contracts, $token, $config)
    {
        $this->email               = $email;
        $this->published_contracts = $published_contracts;
        $this->token               = $token;
        $this->config              = $config;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.newsletter')
                    ->subject($this->config['subject'])
                    ->from($this->config['email'], $this->config['name']);
    }
}
