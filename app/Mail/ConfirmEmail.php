<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ConfirmEmail
 * @package App\Mail
 */
class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Email
     */
    public $email;

    /**
     * Token
     */
    public $token;

    /**
     * Source
     */
    public $source;

    /**
     * Config
     */
    public $config;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $token
     * @param $source
     * @param $config
     */
    public function __construct($email, $token, $source, $config)
    {
        $this->email  = $email;
        $this->token  = $token;
        $this->source = $source;
        $this->config = $config;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.confirmEmail')
                    ->subject("Confirmation Email")
                    ->from($this->config['email'], $this->config['name']);
    }
}
