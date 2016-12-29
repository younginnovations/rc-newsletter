<?php namespace App\Http\Services\Email;

use App\Mail\NewsletterEmail;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendEmailService
 * @package App\Http\Services\Email
 */
class SendEmailService
{
    /**
     * SendEmailService constructor.
     */
    public function __construct()
    {
    }

    /**
     * Sends Email
     *
     * @param $data
     *
     * @return mixed
     */
    public function send($data)
    {
        return Mail::to($data['email'])->send(new NewsletterEmail($data['email'], $data['published_contracts'],
                                                                  $data['token'], $data['config']));
    }

}
