<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $students=Student::latest()->get();
        return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'nullable|email|unique:students,email',
        'phone' => 'required|unique:students,phone|string|max:20',
        'birth_date' => 'nullable|date',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ],[
        'required'=>'هذا الحقل مطلوب',
        'email'=>'يجب ادخال بريد الكتروني صحيح',
        'unique'=>'هذه القيمه موجوده مسبقا',
        'image'=>'يجب ان يكون الملف من نوع صوره',
        'mimes'=>'الرجاء رفع صوره بصيغه jpeg,png,jpg,gif',
    ]);

    // معالجة الصورة
    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('uploads/students', 'public');
    }

    Student::create($validated);

    return back()->with('success', 'تم تسجيل الطالب بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'required'=>'هذا الحقل مطلوب',
            'email'=>'يجب ادخال بريد الكتروني صحيح',
            'unique'=>'هذه القيمه موجوده مسبقا',
            'image'=>'يجب ان يكون الملف من نوع صوره',
            'mimes'=>'الرجاء رفع صوره بصيغه jpeg,png,jpg,gif',
        ]);

        //  تحديث الصورة
        if ($request->hasFile('photo')) {
            //  حذف الصورة القديمة إن وجدت
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            //  تخزين الصورة الجديدة
            $validated['photo'] = $request->file('photo')->store('uploads/students', 'public');
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'تم تحديث بيانات الطالب بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student->invoices()->where('status', 'غير مدفوعة')->exists()) {
            return back()->with('error','هذا الطالب لديه فواتير مستحقه');
        }

        if ($student->photo) {

            $photoPath = str_replace('public/', '', $student->photo);
            Storage::disk('public')->delete($photoPath);
        }

        $student->delete();
        return back()->with('success','تم حذف الطالب بنجاح');

    }
}
