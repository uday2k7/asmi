<?php

namespace App\Console\Commands;

use App\Helpers\MailLib;
use App\Helpers\QueueLib;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails';

    /**
     * Send emails from queue
     * Example: php artisan command:sendEmail
     */
    public function handle()
    {
        $queue = QueueLib::pull('email', true);

        if(!empty($queue))
        {
            // $queue['data'] is $arg here for MailLib::send($arg);
            $queue['data']['send_now'] = true;
            MailLib::send($queue['data']);
            echo 'Email sent successfully';
        }
    }
}
