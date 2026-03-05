<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $invoices=Invoice::with('student','course')->latest()->get();
        return view('invoices.index',compact('invoices'));
    }

    public function create(){
        $courses=Course::all(['id','name','price']);
        $students=Student::all(['id','name']);
        return view('invoices.create',compact('courses','students'));
    }

    public function store(Request $request){

        $validated=$request->validate([
            'student_id'=>'required',
            'course_id'=>'required',
            'status'=>'required|in:مدفوعة,غير مدفوعة',
            'total_amount'=>'required|numeric|min:0',
        ],[
            'required'=>'هذا الحقل مطلوب',
            'numeric'=>'يجب اداخال قيمه رقمية',
        ]);

        Invoice::create($validated);

        $course=Course::find($validated['course_id']);
        $course->students()->syncWithoutDetaching($validated['student_id']);

        return back()->with('success','تم إنشاء الفاتورة بنجاح');


    }

    public function destroy(Invoice $invoice){

        if($invoice->status === 'غير مدفوعة')
            return back()->with('error','عفوا , لم يتم سداد هذه الفاتورة');

        $invoice->delete();
        return back()->with('success','تم حذف الفاتوره بنجاح');

    }
}
