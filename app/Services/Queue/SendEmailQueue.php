<?php namespace App\Services\Queue;

use App\Http\Services\Email\SendEmailService;

/**
 * Class SendEmailQueue
 * @package App\Services\Queue
 */
class SendEmailQueue
{
    /**
     * @var
     */
    public $email;

    /**
     * SendEmailQueue constructor.
     *
     * @param SendEmailService $email
     */
    public function __construct(SendEmailService $email)
    {
        $this->email = $email;
    }

    /**
     * @param $job
     * @param $data
     */
    public function fire($job, $data)
    {
        $this->email->send($data);
        $job->delete();
    }
}
