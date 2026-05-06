<?php

namespace App\Livewire;

use App\Models\StudentRecord;
use App\Models\ExamRecord;
use App\Models\Timetable;
use App\Models\FeeInvoice;
use Livewire\Component;

class StudentPortal extends Component
{
   public StudentRecord $student;
   public $activeTab = 'overview';

   public function mount()
   {
       // Get authenticated user's student record
       $this->student = StudentRecord::where('user_id', auth()->id())->firstOrFail();
   }

   public function render()
   {
       $upcomingExams = ExamRecord::with('exam')
           ->where('student_record_id', $this->student->id)
           ->whereHas('exam', fn($q) => $q->where('status', 'active'))
           ->get()
           ->take(5);

       $recentGrades = ExamRecord::with(['exam.semester', 'gradeSystem'])
           ->where('student_record_id', $this->student->id)
           ->orderBy('created_at', 'desc')
           ->limit(5)
           ->get();

       $timetableEntries = Timetable::with(['myClass', 'section', 'subject.teacher.user', 'timeSlot'])
           ->where('my_class_id', $this->student->my_class_id)
           ->where('section_id', $this->student->section_id)
           ->where('semester_id', session('semester_id'))
           ->get()
           ->groupBy('weekday');

       $pendingFees = FeeInvoice::with('feeCategory')
           ->where('student_record_id', $this->student->id)
           ->where('status', 'unpaid')
           ->get();

       $attendanceRate = $this->calculateAttendanceRate();

       return view('livewire.student-portal', [
           'upcomingExams' => $upcomingExams,
           'recentGrades' => $recentGrades,
           'timetableEntries' => $timetableEntries,
           'pendingFees' => $pendingFees,
           'attendanceRate' => $attendanceRate,
       ]);
   }

   private function calculateAttendanceRate(): float
   {
       // Simplified: fetch attendance count for the student
       // This would depend on your attendance tracking implementation
       return rand(85, 99); // placeholder — replace with actual calculation
   }

   public function setTab($tab)
   {
       $this->activeTab = $tab;
   }
}
