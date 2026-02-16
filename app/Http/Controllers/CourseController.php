<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses=Course::with('instructor')->latest()->get();
        return view('courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors=Instructor::all();
        return view('courses.create',compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required',
            'instructor_id'=>'required | exists:instructors,id',
            'description'=>'nullable',
            'hours'=>'required | integer | min:1',
            'price'=>'required | numeric | min:0',
            'start_date'=>'required | date',
            'end_date'=>'required | date | after_or_equal:start_date',
        ],[
            'required'=>'هذا الحقل مطلوب ',
            'instructor_id.exists'=>'المدرب غير موجود',
            'hours.min'=>'القيمه اقل من 1 ساعه',
            'hours.integer'=>'يجب ادخال عدد صحيح',
            'price.numeric'=>'يجب ادخال قيمه رقميه',
            'start_date.date'=>'يجيب ادخال قيمه تاريخ صحيح',
            'end_date.date'=>'يجيب ادخال قيمه تاريخ صحيح',
            'end_date.after_or_equal'=>'يجب ان يكون تاريخ الانتهاء بعد تاريخ البدايه',

        ]);

        Course::create($validate);

        return back()->with('success','تم إضافة كورس جديد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $instructors=Instructor::all();
        return view('courses.edit',compact('course','instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validate=$request->validate([
            'name'=>'required',
            'instructor_id'=>'required | exists:instructors,id',
            'description'=>'nullable',
            'hours'=>'required | integer | min:1',
            'price'=>'required | numeric | min:0',
            'start_date'=>'required | date',
            'end_date'=>'required | date | after_or_equal:start_date',
        ],[
            'required'=>'هذا الحقل مطلوب ',
            'instructor_id.exists'=>'المدرب غير موجود',
            'hours.min'=>'القيمه اقل من 1 ساعه',
            'hours.integer'=>'يجب ادخال عدد صحيح',
            'price.numeric'=>'يجب ادخال قيمه رقميه',
            'start_date.date'=>'يجيب ادخال قيمه تاريخ صحيح',
            'end_date.date'=>'يجيب ادخال قيمه تاريخ صحيح',
            'end_date.after_or_equal'=>'يجب ان يكون تاريخ الانتهاء بعد تاريخ البدايه',

        ]);

        $course->update($validate);
        return back()->with('success','تم تعديل بيانات الكورس بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        
        //  التحقق من وجود طلاب مسجلين
        if ($course->students()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف هذا الكورس لأنه به طلاب مسجلين حالياً.');
        }

        //  التحقق من وجود فواتير مرتبطة
        if ($course->invoices()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف هذا الكورس لأنه مرتبط بفواتير.');
        }

        //  التحقق من وجود جلسات   
        if ($course->courseSessions()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف الكورس لأنه يحتوي على جلسات دراسية.');
        }

        $course->delete();

        return back()->with('success', 'تم حذف الكورس بنجاح.');
    }
    
}
