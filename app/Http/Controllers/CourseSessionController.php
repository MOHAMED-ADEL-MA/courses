<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSession;
use Illuminate\Http\Request;

class CourseSessionController extends Controller
{
    public function index(Request $request){
        $query=CourseSession::with('course');
        if($request->course_id){
            $query->where('course_id', $request->course_id);
        }

        $sessions=$query->latest()->get();
        $courses=Course::all();

        return view('sessions.index',compact('sessions','courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'time' => 'required',
            'hall' => 'required|string',
            'status' => 'required|in:pending,completed',
        ],[
            'required'=> 'هذا الحقل مطلوب',
            'exists'=> 'هذه القيمة غير موجودة',
            'date'=> 'يجب ادخال تاريخ صالح',

        ]);

        CourseSession::create($validated);
        return back()->with('success', 'تم إضافة الجلسة بنجاح');
    }

    public function endSession( CourseSession $session){
        // $session->update([
        //     'status'=>'completed',
        // ]);
        $session->status = 'completed' ;
        $session->save();
        return back()->with('success','انتهت الجلسة بنجاح');
    }
    public function destroy(CourseSession $session)
    {
        // منع الحذف إذا تم تسجيل حضور
        if ($session->attendances()->count() > 0 || $session->status == 'completed') {
            return back()->with('error', 'لا يمكن حذف جلسة منتهية او تم تسجيل حضور لها بالفعل.');
        }

        $session->delete();
        return back()->with('success', 'تم حذف الجلسة بنجاح');
    }
}
