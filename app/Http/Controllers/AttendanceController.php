<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\CourseSession;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create(CourseSession $session)
    {
        //  جلب الطلاب المسجلين في الكورس الخاص بالجلسة
        $students = $session->course->students;

        //  التحقق: هل تم إنشاء سجلات الحضور لهذه الجلسة من قبل
        $existingAttendance = $session->attendances->keyBy('student_id');

        //    تسجيل الغياب تلقائياً
        if ($existingAttendance->isEmpty()) {
            foreach ($students as $student) {
                Attendance::create([
                    'courceSession_id' => $session->id,
                    'student_id' => $student->id,
                    'status' => 'absent'
                ]);
            }
            $attendances = $session->attendances;
        } else {
            $attendances = $existingAttendance;
        }

        return view('attendance.create', compact('session', 'students', 'attendances'));
    }

    public function store(Request $request, CourseSession $session)
    {
        foreach ($request->status as $studentId => $status) {
            Attendance::updateOrCreate(
                ['courceSession_id' => $session->id, 'student_id' => $studentId],
                ['status' => $status]
            );
        }



        return redirect()->route('sessions.index')->with('success', 'تم تسجيل الحضور بنجاح');
    }
}
