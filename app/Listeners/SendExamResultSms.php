<?php

namespace App\Listeners;

use App\Services\AutoSmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendExamResultSms implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(
        protected AutoSmsService $autoSms
    ) {}

    /**
     * Handle the event.
     * Expects array of exam_record IDs
     */
    public function handle(object $event): void
    {
        $recordIds = $event->recordIds ?? [];
        if (!empty($recordIds)) {
            $this->autoSms->sendExamResultNotification($recordIds);
        }
    }
}
