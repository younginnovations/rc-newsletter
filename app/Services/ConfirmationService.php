<?php
namespace App\Services;

use App\Http\Models\Subscriber;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

/**
 * Class ConfirmationService
 * @package App\Services
 */
class ConfirmationService
{
    /**
     * ConfirmationService constructor.
     */
    public function __construct()
    {
    }

    /**
     * Send confirmation email to subscriber
     *
     * @param Subscriber $subscriber
     *
     * @param            $config
     *
     * @return
     */
    public function sendConfirmationEmail(Subscriber $subscriber, $config)
    {
        return Mail::to($subscriber->email)->send(new ConfirmEmail($subscriber->email, $subscriber->token, $subscriber->source, $config));
    }
}
