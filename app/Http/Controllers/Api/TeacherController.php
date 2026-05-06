<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherRecord;
use App\Models\ExamRecord;

class TeacherController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();
        $teacher = TeacherRecord::where('user_id', $user->id)->firstOrFail();
        $subjectCount = $teacher->subjects()->count();
        $classesToday = \App\Models\TimetableEntry::where('teacher_id', $teacher->id)
            ->where('weekday', now()->dayOfWeek)
            ->count();
        $upcomingExams = \App\Models\Exam::whereIn('subject_id', $teacher->subjects->pluck('id'))
            ->where('date', '>=', now())
            ->count();
        $recentGrades = ExamRecord::whereIn('subject_id', $teacher->subjects->pluck('id'))
            ->whereNotNull('graded_by')
            ->count();

        return response()->json([
            'subject_count' => $subjectCount,
            'classes_today' => $classesToday,
            'upcoming_exams' => $upcomingExams,
            'recent_grades_count' => $recentGrades,
        ]);
    }

    public function schedule(Request $request)
    {
        $user = $request->user();
        $teacher = TeacherRecord::where('user_id', $user->id)->firstOrFail();
        $entries = \App\Models\TimetableEntry::with(['myClass', 'section', 'subject', 'timeSlot'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('weekday')
            ->orderBy('time_slot_id')
            ->get()
            ->groupBy('weekday');
        return response()->json($entries);
    }

    public function classes(Request $request)
    {
        $user = $request->user();
        $teacher = TeacherRecord::where('user_id', $user->id)->firstOrFail();
        $subjects = $teacher->subjects()->with(['myClass', 'section'])->get()->map(fn($s) => [
            'id' => $s->id,
            'name' => $s->name,
            'class' => $s->myClass->name ?? 'N/A',
            'section' => $s->section->name ?? 'N/A',
            'code' => $s->code,
        ]);
        return response()->json($subjects);
    }

    public function grading(Request $request)
    {
        $user = $request->user();
        $teacher = TeacherRecord::where('user_id', $user->id)->firstOrFail();
        $records = ExamRecord::with(['student.user', 'exam', 'subject'])
            ->whereIn('subject_id', $teacher->subjects->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->map(fn($r) => [
                'id' => $r->id,
                'student_name' => $r->student?->user?->name ?? 'N/A',
                'exam_title' => $r->exam->title ?? 'N/A',
                'subject' => $r->subject->name ?? 'N/A',
                'score' => $r->score,
                'grade' => $r->grade,
                'graded_at' => $r->created_at,
            ]);
        return response()->json($records);
    }
}
