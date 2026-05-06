<?php

namespace App\Listeners;

use App\Events\StudentAbsent;
use App\Services\AutoSmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAttendanceAlertSms implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(
        protected AutoSmsService $autoSms
    ) {}

    public function handle(StudentAbsent $event): void
    {
        // Event carries: studentId, classId, sectionId, date
        $this->autoSms->sendAttendanceAlert(
            $event->classId,
            $event->sectionId,
            $event->date,
            [$event->studentId]
        );
    }
}
