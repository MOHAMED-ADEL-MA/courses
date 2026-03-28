<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors=Instructor::all();
        return view('instructors.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instructors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'email|unique:instructors,email',
            'experience_years' => 'nullable|integer|',
        ],[
            'email.email'=>'يجب ادخال بريد الكتروني صالح',
            'email.unique'=>'هذا البريد مستخدم من قبل',
            'experience_years.integer'=>'يجب ادخال عدد صحيح',
        ]);

        if ($validated['experience_years']== null){
            $validated['experience_years']= 0;
        }

        // 2. إنشاء المدرب الجديد في قاعدة البيانات
        Instructor::create($validated);

        // 3. العودة مع رسالة نجاح
        return back()->with('success', 'تم إضافة المدرب بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        return view('instructors.edit',compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        // 1. التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => ['email',
                Rule::unique('instructors','email')
                ->ignore($instructor->id)
            ],
            'experience_years' => 'nullable|integer|',
        ],[
            'email.email'=>'يجب ادخال بريد الكتروني صالح',
            'email.unique'=>'هذا البريد مستخدم من قبل',
            'experience_years.integer'=>'يجب ادخال عدد صحيح',
        ]);

        if ($validated['experience_years']== null){
            $validated['experience_years']= 0;
        }

        // 2. إنشاء المدرب الجديد في قاعدة البيانات
        $instructor->update($validated);

        // 3. العودة مع رسالة نجاح
        return back()->with('success', 'تم تعديل بيانات المدرب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        if($instructor->has('courses'))
            return back()->with('error','عفوا هذ المدرب مرتبط بكورسات ');
        $instructor->delete();
        return back()->with('success','تم حذف بيانات المدرب بنجاح');
    }
}
