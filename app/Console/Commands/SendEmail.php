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
    protected $name = 'send:email';

    protected $email;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email.';

    public function __construct(CreateEmailService $email)
    {
        parent::__construct();
        $this->email = $email;
    }


    /**
     * Execute bash file
     */
    public function fire()
    {
        $this->info("Sending e-mail...");
        $this->email->create();
        $this->info("E-mail sent to all subscribers.");
    }

}
