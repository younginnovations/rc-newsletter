<?php namespace App\Http\Services\Email;

use App\Http\Services\Setting\SettingService;
use Illuminate\Contracts\Queue\Queue;

/**
 * Class SendToEmailQueueService
 * @package App\Http\Services\Email
 */
class SendToEmailQueueService
{
    /**
     * SendToEmailQueueService constructor.
     *
     * @param Queue          $queue
     * @param SettingService $setting
     */
    public function __construct(Queue $queue, SettingService $setting)
    {
        $this->queue   = $queue;
        $this->setting = $setting;
    }

    /**
     * Sends email to queue
     *
     * @param $email
     * @param $dataForEmail
     * @param $token
     */
    public function send($email, $dataForEmail, $token)
    {
        $data = [
            'email'               => $email,
            'published_contracts' => $dataForEmail,
            'token'               => $token,
            'config'              => $this->setting->getConfig(),
        ];
        $this->queue->push(
            'App\Services\Queue\SendEmailQueue',
            $data,
            'send_email'
        );
    }
}
