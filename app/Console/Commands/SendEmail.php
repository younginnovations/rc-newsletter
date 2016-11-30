<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\Queue;

/*
 * Send Email to subscribed users
 */

class SendEmail extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'send:email';
    /**
     * @var Queue
     */
    protected $queue;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email.';

    public function __construct(Queue $queue)
    {
        parent::__construct();
        $this->queue = $queue;
    }


    /**
     * Execute bash file
     */
    public function fire()
    {
        $this->info("File zipped");
        $data = "yay";
        $this->queue->push(
            'App\Services\Queue\SendEmailQueue',
            $data,
            'send_email'
        );

    }

}
