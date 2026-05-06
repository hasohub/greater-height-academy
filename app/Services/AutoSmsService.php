<?php

namespace App\Services;

use App\Models\StudentRecord;
use App\Models\ParentRecord;
use App\Models\ParentRecordUser;
use App\Models\FeeInvoice;
use App\Services\SmsService;
use Illuminate\Support\Facades\Log;

class AutoSmsService
{
   protected SmsService $sms;

   public function __construct()
   {
       $this->sms = new SmsService();
   }

   /**
    * Send attendance alert to all parents of students in the given class/section
    */
   public function sendAttendanceAlert($classId, $sectionId, $date, $absentStudentIds = [])
   {
       // Get students in class/section
       $students = StudentRecord::where('my_class_id', $classId)
           ->where('section_id', $sectionId)
           ->with(['user', 'parents'])
           ->get();

       foreach ($students as $student) {
           $isAbsent = in_array($student->id, $absentStudentIds);
           $message = $isAbsent
               ? "Dear Parent,\n\nYour child {$student->user->name} was absent on {$date}.\n\nPlease contact the school if this is incorrect.\n\nGreater Height Academy"
               : null; // only send if absent

           if ($message) {
               foreach ($student->parents as $parent) {
                   if ($parent->user && $parent->user->phone) {
                       $this->sms->send($parent->user->phone, $message, ['type' => 'attendance']);
                   }
               }
           }
       }
   }

   /**
    * Send bulk fee reminders to parents with overdue invoices
    */
   public function sendFeeReminders($daysBeforeDue = 7)
   {
       $dueDate = now()->addDays($daysBeforeDue)->toDateString();

       $upcomingInvoices = FeeInvoice::with(['studentRecord.user', 'feeCategory'])
           ->where('status', 'unpaid')
           ->whereDate('due_date', '<=', $dueDate)
           ->get();

       foreach ($upcomingInvoices as $invoice) {
           $student = $invoice->studentRecord;
           if (!$student) continue;

           foreach ($student->parents as $parent) {
               if ($parent->user && $parent->user->phone) {
                   $msg = "Dear Parent,\n\nThis is a reminder that the fee payment of \$" . number_format($invoice->amount, 2) . " for " . ($invoice->feeCategory->name ?? 'fees') . " is due by " . $invoice->due_date->format('d M Y') . ".\n\nPlease make payment to avoid late fees.\n\nGreater Height Academy";
                   $this->sms->send($parent->user->phone, $msg, ['type' => 'fees', 'related_id' => $invoice->id]);
               }
           }
       }
   }

   /**
    * Notify parents when exam results are published for their child
    */
   public function sendExamResultNotification($examRecordIds)
   {
       $examRecords = \App\Models\ExamRecord::with(['student.user.parents', 'exam'])
           ->whereIn('id', $examRecordIds)
           ->get();

       foreach ($examRecords as $examRecord) {
           $student = $examRecord->student;
           if (!$student) continue;

           foreach ($student->parents as $parent) {
               if ($parent->user && $parent->user->phone) {
                   $msg = "Dear Parent,\n\nThe results for " . ($examRecord->exam->title ?? "your child's exam") . " have been published.\n\nPlease log in to the Greater Height Academy portal to view the detailed report.\n\nPortal: " . config('app.url') . "/dashboard\n\nGreater Height Academy";
                   $this->sms->send($parent->user->phone, $msg, ['type' => 'exam', 'related_id' => $examRecord->id]);
               }
           }
       }
   }

   /**
    * Broadcast a notice to all parents (and optionally students/teachers)
    */
   public function broadcastNotice($title, $content, $recipients = ['parents'])
   {
       $phones = collect();

       if (in_array('parents', $recipients)) {
           $parentPhones = ParentRecord::with('user')->get()
               ->pluck('user.phone')
               ->filter();
           $phones = $phones->merge($parentPhones);
       }

       if (in_array('students', $recipients)) {
           $studentPhones = \App\Models\StudentRecord::with('user')->get()
               ->pluck('user.phone')
               ->filter();
           $phones = $phones->merge($studentPhones);
       }

       if (in_array('teachers', $recipients)) {
           $teacherPhones = \App\Models\TeacherRecord::with('user')->get()
               ->pluck('user.phone')
               ->filter();
           $phones = $phones->merge($teacherPhones);
       }

       $message = "{$title}\n\n{$content}\n\n— Greater Height Academy";

       foreach ($phones->unique() as $phone) {
           $this->sms->send($phone, $message, ['type' => 'notice']);
       }
   }
}
