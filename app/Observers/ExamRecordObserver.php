<?php

namespace App\Observers;

use App\Models\ExamRecord;

class ExamRecordObserver
{
    /**
     * Handle the ExamRecord "created" event.
     */
    public function created(ExamRecord $examRecord): void
    {
        //
    }

    /**
     * Handle the ExamRecord "updated" event.
     */
    public function updated(ExamRecord $examRecord): void
    {
        //
    }

    /**
     * Handle the ExamRecord "deleted" event.
     */
    public function deleted(ExamRecord $examRecord): void
    {
        //
    }

    /**
     * Handle the ExamRecord "restored" event.
     */
    public function restored(ExamRecord $examRecord): void
    {
        //
    }

    /**
     * Handle the ExamRecord "force deleted" event.
     */
    public function forceDeleted(ExamRecord $examRecord): void
    {
        //
    }
}
