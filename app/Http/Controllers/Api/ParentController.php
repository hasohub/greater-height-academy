<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentRecord;
use App\Models\StudentRecord;
use App\Models\ExamRecord;
use App\Models\FeeInvoice;
use App\Models\TimetableEntry;

class ParentController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();
        $parent = ParentRecord::where('user_id', $user->id)->firstOrFail();
        $children = $parent->students()->with('user')->get();
        $childData = $children->map(function ($student) {
            $attendanceRate = 94;
            $gpa = ExamRecord::where('student_record_id', $student->id)->whereNotNull('score')->avg('score') ?? 0;
            $upcomingExams = ExamRecord::where('student_record_id', $student->id)
                ->whereHas('exam', fn($q) => $q->where('date', '>=', now()))
                ->count();
            $pendingFees = FeeInvoice::where('student_record_id', $student->id)
                ->where('status', 'unpaid')
                ->sum('amount');
            return [
                'id' => $student->id,
                'name' => $student->user->name ?? 'N/A',
                'admission_no' => $student->admission_no,
                'attendance_rate' => round($attendanceRate, 1),
                'gpa' => round($gpa, 2),
                'upcoming_exams' => $upcomingExams,
                'pending_fees' => $pendingFees,
            ];
        });
        return response()->json(['children' => $childData]);
    }

    public function timetable(Request $request, $studentId)
    {
        $user = $request->user();
        $parent = ParentRecord::where('user_id', $user->id)->firstOrFail();
        $student = StudentRecord::where('id', $studentId)
            ->whereIn('id', $parent->students->pluck('id'))
            ->firstOrFail();
        $entries = TimetableEntry::with(['subject', 'teacher.user', 'myClass', 'section', 'timeSlot'])
            ->where('class_id', $student->my_class_id)
            ->where('section_id', $student->section_id)
            ->where('academic_year_id', $student->academic_year_id)
            ->orderBy('weekday')
            ->orderBy('time_slot_id')
            ->get()
            ->groupBy('weekday');
        return response()->json($entries);
    }

    public function grades(Request $request, $studentId)
    {
        $user = $request->user();
        $parent = ParentRecord::where('user_id', $user->id)->firstOrFail();
        $student = StudentRecord::where('id', $studentId)
            ->whereIn('id', $parent->students->pluck('id'))
            ->firstOrFail();
        $records = ExamRecord::with(['exam', 'subject'])
            ->where('student_record_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->map(fn($r) => [
                'id' => $r->id,
                'exam_title' => $r->exam->title ?? 'N/A',
                'subject' => $r->subject->name ?? 'N/A',
                'score' => $r->score,
                'grade' => $r->grade,
                'remarks' => $r->remarks,
                'date' => $r->exam->date ?? null,
            ]);
        return response()->json($records);
    }

    public function fees(Request $request, $studentId)
    {
        $user = $request->user();
        $parent = ParentRecord::where('user_id', $user->id)->firstOrFail();
        $student = StudentRecord::where('id', $studentId)
            ->whereIn('id', $parent->students->pluck('id'))
            ->firstOrFail();
        $invoices = FeeInvoice::with(['feeCategory'])
            ->where('student_record_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->map(fn($i) => [
                'id' => $i->id,
                'amount' => $i->amount,
                'due_date' => $i->due_date,
                'status' => $i->status,
                'category' => $i->feeCategory->name ?? 'Fee',
                'description' => $i->description,
            ]);
        return response()->json($invoices);
    }

    public function notices(Request $request)
    {
        $notices = \App\Models\Notice::orderBy('created_at', 'desc')
            ->limit(20)
            ->get()
            ->map(fn($n) => [
                'id' => $n->id,
                'title' => $n->title,
                'content' => $n->content,
                'created_at' => $n->created_at,
            ]);
        return response()->json($notices);
    }
}
