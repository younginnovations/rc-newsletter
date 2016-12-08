<?php namespace App\Http\Services;


use App\Mail\NewsletterEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailService
{
    public function __construct()
    {
    }

    /**
     * write brief description
     *
     * @param $data
     *
     * @return mixed
     */
    public function send($data)
    {
        return Mail::to($data['email'])->send(new NewsletterEmail($data['email'], $data['published_contracts'],
                                                                  $data['token']));
    }

}
