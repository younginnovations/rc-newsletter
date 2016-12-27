<?php namespace App\Console\Commands;

use App\Http\Services\CreateEmailService;
use Illuminate\Console\Command;
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
    protected $name = 'newsletter:send';
    /**
     * The email of subscriber.
     *
     * @var string
     */
    protected $email;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email.';
    /**
     * SendEmail constructor.
     *
     * @param CreateEmailService $email
     */
    public function __construct(CreateEmailService $email)
    {
        parent::__construct();
        $this->email = $email;
    }
    /**
     * Sends email
     */
    public function fire()
    {
        $this->info("Sending e-mail...");
        $this->email->send();
        $this->info("E-mail sent to all subscribers.");
    }
}
