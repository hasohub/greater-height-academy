<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AutoSmsService;

class SendFeeReminders extends Command
{
    protected $signature = 'sms:send-fee-reminders {--days=7 : Days before due date to remind}';
    protected $description = 'Send fee reminder SMS to parents for upcoming invoices';

    public function handle(AutoSmsService $autoSms): int
    {
        $days = $this->option('days');
        $autoSms->sendFeeReminders($days);
        $this->info("Fee reminders sent for invoices due within {$days} days.");
        return 0;
    }
}
