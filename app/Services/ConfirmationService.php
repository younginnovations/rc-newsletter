<?php
namespace App\Services;

use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

/**
 * Class ConfirmationService
 * @package App\Services
 */
class ConfirmationService
{


    public function __construct()
    {
    }

    /**
     * write brief description
     *
     * @param $email
     * @param $token
     */
    public function sendConfirmationEmail($email, $token)
    {
        return Mail::to($email)->send(new ConfirmEmail($email, $token));
    }
}
