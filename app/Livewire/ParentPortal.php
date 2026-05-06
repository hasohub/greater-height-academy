<?php

namespace App\Livewire;

use App\Models\ParentRecord;
use App\Models\StudentRecord;
use App\Models\ExamRecord;
use App\Models\FeeInvoice;
use App\Models\Timetable;
use Livewire\Component;

class ParentPortal extends Component
{
   public ParentRecord $parent;
   public string $activeTab = 'children';
   public ?int $selectedStudentId = null;

   public function mount()
   {
       $this->parent = ParentRecord::where('user_id', auth()->id())->firstOrFail();
       $this->selectedStudentId = $this->parent->students->first()->id ?? null;
   }

   public function getSelectedStudentProperty()
   {
       return StudentRecord::find($this->selectedStudentId);
   }

   public function render()
   {
       $children = $this->parent->students()->with(['user', 'myClass', 'section'])->get();

       $selectedStudent = $this->getSelectedStudentProperty();

       $upcomingExams = collect();
       $timetable = collect();
       $pendingFees = collect();
       $recentGrades = collect();
       $attendanceRate = 0;

       if ($selectedStudent) {
           $upcomingExams = ExamRecord::with('exam')
               ->where('student_record_id', $selectedStudent->id)
               ->whereHas('exam', fn($q) => $q->where('status', 'active'))
               ->get()
               ->take(5);

           $timetable = Timetable::with(['myClass', 'section', 'subject.teacher.user', 'timeSlot'])
               ->where('my_class_id', $selectedStudent->my_class_id)
               ->where('section_id', $selectedStudent->section_id)
               ->where('semester_id', session('semester_id'))
               ->get()
               ->groupBy('weekday');

           $pendingFees = FeeInvoice::with('feeCategory')
               ->where('student_record_id', $selectedStudent->id)
               ->where('status', 'unpaid')
               ->get();

           $recentGrades = ExamRecord::with(['exam.semester', 'gradeSystem'])
               ->where('student_record_id', $selectedStudent->id)
               ->orderBy('created_at', 'desc')
               ->limit(5)
               ->get();

           $attendanceRate = rand(85, 99); // replace with actual attendance calc
       }

       return view('livewire.parent-portal', [
           'children' => $children,
           'selectedStudent' => $selectedStudent,
           'upcomingExams' => $upcomingExams,
           'timetable' => $timetable,
           'pendingFees' => $pendingFees,
           'recentGrades' => $recentGrades,
           'attendanceRate' => $attendanceRate,
       ]);
   }

   public function changeStudent($studentId)
   {
       $this->selectedStudentId = $studentId;
       $this->activeTab = 'overview';
   }
}
