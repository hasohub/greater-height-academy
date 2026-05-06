<?php

namespace App\Livewire;

use App\Models\TeacherRecord;
use App\Models\MyClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\Exam;
use App\Models\ExamRecord;
use Livewire\Component;

class TeacherPortal extends Component
{
   public TeacherRecord $teacher;
   public string $activeTab = 'overview';

   public function mount()
   {
       $this->teacher = TeacherRecord::where('user_id', auth()->id())->firstOrFail();
   }

   public function render()
   {
       // Classes the teacher teaches
       $assignedSubjects = Subject::whereHas('teachers', fn($q) => $q->where('teacher_id', $this->teacher->id))
                                   ->with(['myClass.section', 'teachers.user'])
                                   ->get()
                                   ->unique('id');

       // Today's timetable (simplified)
       $todayTimetable = Timetable::with(['subject', 'myClass.section', 'timeSlot'])
           ->whereHas('subject.teachers', fn($q) => $q->where('teacher_id', $this->teacher->id))
           ->where('weekday_id', now()->dayOfWeek) // assuming weekday id matches
           ->get();

       // Upcoming exams for teacher's subjects
       $upcomingExams = Exam::with(['subject', 'semester'])
           ->whereHas('subject', fn($q) => $q->whereHas('teachers', fn($q2) => $q2->where('teacher_id', $this->teacher->id)))
           ->where('status', 'active')
           ->where('start_date', '>=', now())
           ->orderBy('start_date')
           ->limit(5)
           ->get();

       // Recent grading activity
       $recentGrading = ExamRecord::with(['student.user', 'exam.subject'])
           ->whereHas('exam.subject.teachers', fn($q) => $q->where('teacher_id', $this->teacher->id))
           ->orderBy('created_at', 'desc')
           ->limit(10)
           ->get();

       return view('livewire.teacher-portal', [
           'assignedSubjects' => $assignedSubjects,
           'todayTimetable' => $todayTimetable,
           'upcomingExams' => $upcomingExams,
           'recentGrading' => $recentGrading,
       ]);
   }

   public function setTab(string $tab)
   {
       $this->activeTab = $tab;
   }
}
