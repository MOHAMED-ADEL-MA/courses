<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Request $request)
{
    $query = Invoice::with('student', 'course');

    // فلترة حسب حالة السداد
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    // فلترة حسب الطالب
    if ($request->has('student_id') && $request->student_id != '') {
        $query->where('student_id', $request->student_id);
    }

    // فلترة حسب الكورس
    if ($request->has('course_id') && $request->course_id != '') {
        $query->where('course_id', $request->course_id);
    }

    $invoices = $query->latest()->get();
    $students = Student::all(); // للقائمة المنسدلة في الفلتر
    $courses = Course::all();  // للقائمة المنسدلة في الفلتر

    return view('invoices.index', compact('invoices', 'students', 'courses'));
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
            'total_amount'=>'required|numeric|min:0',
        ],[
            'required'=>'هذا الحقل مطلوب',
            'numeric'=>'يجب اداخال قيمه رقمية',
        ]);

        $validated['status']='غير مدفوعة';
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

    public function addPayment(Request $request, Invoice $invoice){
        $validated=$request->validate([
            'amount'=>'required| numeric| min:0.01'
        ],[
            'required'=>'هذا الحقل مطلوب',
            'numeric'=>'يجب ادخال قيمة عددية',
            'min'=>'يجب ان يكون المبلغ اكبر من 0 جنيه',
        ]);

        $remaining=$invoice->remaining_amount;

        if($validated['amount'] > $remaining)
            return back()->with('error','المبلغ المدفوع  ' .$validated['amount'].  '   اكبر من المبلغ المتبقي  '. $remaining);

        Payment::create([
            'invoice_id'=>$invoice->id,
            'amount'=>$validated['amount']
        ]);

        $newRemaining=$remaining-$validated['amount'];

        if($newRemaining == 0)
            $invoice->status = 'مدفوعة';
        else
            $invoice->status = 'مدفوعة جزئيا';

        $invoice->save();

        return back()->with('success','تم تسجيل الدفعة بنجاح');

    }
    public function downloadPdf(Invoice $invoice)
{
    $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
    return $pdf->download('invoice_' . $invoice->id . '.pdf');
}
}
