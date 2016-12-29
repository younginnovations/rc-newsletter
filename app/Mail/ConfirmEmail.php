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
     * Config
     */
    public $config;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $token
     * @param $config
     */
    public function __construct($email, $token, $config)
    {
        $this->email  = $email;
        $this->token  = $token;
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
