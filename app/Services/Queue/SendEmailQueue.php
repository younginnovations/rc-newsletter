<?php
namespace App\Services\Queue;


class SendEmailQueue
{
    /**
     * @var
     */
    //public $newsletter;

    public function __construct()
    {
        //$this->newsletter = $newsletter;
    }

    /**
     * @param $job
     * @param $data
     */
    public function fire($job, $data)
    {
        dd($data);
        //$this->newsletter->post($data);
        $job->delete();
    }
}
