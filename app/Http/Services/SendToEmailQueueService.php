<?php namespace App\Http\Services;

use Illuminate\Contracts\Queue\Queue;

class SendToEmailQueueService
{
    /**
     * SendToEmailQueueService constructor.
     *
     * @param Queue $queue
     */
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
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
        ];
        $this->queue->push(
            'App\Services\Queue\SendEmailQueue',
            $data,
            'send_email'
        );
    }
}