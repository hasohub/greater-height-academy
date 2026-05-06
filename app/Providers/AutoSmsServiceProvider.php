<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AutoSmsService;
use App\Events\StudentAbsent;
use App\Listeners\SendAttendanceAlertSms;
use App\Listeners\SendFeeReminderSms;
use App\Listeners\SendExamResultSms;
use Illuminate\Support\Facades\Event;

class AutoSmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind AutoSmsService to container
        $this->app->singleton(AutoSmsService::class, function ($app) {
            return new AutoSmsService();
        });
    }

    public function boot(): void
    {
        // Auto-SMS only if enabled in .env
        if (!config('services.auto_sms_attendance', false) &&
            !config('services.auto_sms_fees', false) &&
            !config('services.auto_sms_results', false)) {
            return;
        }

        // Register event listeners if auto-SMS is enabled
        if (config('services.auto_sms_attendance')) {
            Event::listen(StudentAbsent::class, SendAttendanceAlertSms::class);
        }

        // Fee reminder — run via scheduler (daily)
        // Exam result — triggered when exam record created/updated
    }
}
