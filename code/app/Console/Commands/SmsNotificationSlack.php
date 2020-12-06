<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TextSlack\SmsNotification;
use App\Notifications\InboundSmsMessage;

class SmsNotificationSlack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:notification:slack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $from = '9995551111';
        $message = 'A command text message';
        $notification = new SmsNotification;
        $notification->notify(new InboundSmsMessage($from, $message));
        return 0;
    }
}
