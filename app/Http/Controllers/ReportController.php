<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcel;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Maatwebsite\Excel\Facades\Excel as Excel;



class ReportController extends Controller
{
    // عرض صفحة التقارير الرئيسية مع الفلاتر
    public function index(Request $request)
    {
        $viewType=$request->input('view','students');

        $courses=Course::all();
        $items=collect();

        switch($viewType){
            //تقرير الطلاب
            case 'students':
                $items= Student::with('courses')
                ->when($request->course_id, function($q) use($request){
                    $q->whereHas('courses', function($q2) use($request){
                        $q2->where('course_id',$request->course_id);
                    });
                })->get();

                break;
            //تقرير المدفوعات
            case 'payments':
                $items=Invoice::with(['student','course'])
                ->when($request->status,fn($q)=>
                    $q->where('status',$request->status))
                ->when($request->course_id, fn($q2)=>
                    $q2->where('course_id',$request->course_id))
                ->get();
                break;
            //تقرير الحضور
            case 'attendance':
                $items=Attendance::with(['student','courseSession.course'])
                ->when($request->course_id, fn($q)=>
                    $q->whereHas('courseSession', fn($q2)=>
                        $q2->where('course_id',$request->course_id)))
                ->when($request->date_from,fn($q)=>
                    $q->whereHas('courseSession',fn($q2)=>
                        $q2->whereDate('date','>=',$request->date_from)))
                ->get();
                break;
            //تقرير المدربين
            case 'instructors':
                $items=Instructor::withCount('courses')->get();
                break;
        }
        return view("reports.index",compact("items","courses","viewType"));

    }

     // دالة تصدير PDF
    public function exportPdf(Request $request)
    {

        $viewType = $request->input('view', 'students');
        $items = [];
        $title = '';

        switch($viewType){
            //تقرير الطلاب
            case 'students':
                $items= Student::with('courses')
                ->when($request->course_id, function($q) use($request){
                    $q->whereHas('courses', function($q2) use($request){
                        $q2->where('course_id',$request->course_id);
                    });
                })->get();
                $title='تقرير الطلاب';

                break;
            //تقرير المدفوعات
            case 'payments':
                $items=Invoice::with(['student','course'])
                ->when($request->status,fn($q)=>
                    $q->where('status',$request->status))
                ->when($request->course_id, fn($q2)=>
                    $q2->where('course_id',$request->course_id))
                ->get();
                $title='تقرير المدفوعات';
                break;
            //تقرير الحضور
            case 'attendance':
                $items=Attendance::with(['student','courseSession.course'])
                ->when($request->course_id, fn($q)=>
                    $q->whereHas('courseSession', fn($q2)=>
                        $q2->where('course_id',$request->course_id)))
                ->when($request->date_from,fn($q)=>
                    $q->whereHas('courseSession',fn($q2)=>
                        $q2->whereDate('date','>=',$request->date_from)))
                ->get();
                $title='تقرير الحضور';
                break;
            //تقرير المدربين
            case 'instructors':
                $items=Instructor::with('courses')->get();
                $title= 'تقرير المدربين';
                break;
        }

        $pdf = PDF::loadView('reports.pdf', compact('items', 'title', 'viewType'));
        return $pdf->download('report_' . $viewType . '.pdf');
    }

    public function exportExcel(Request $request,){

        $viewType = $request->input('view', 'students');

        if($viewType== 'students'){
            return Excel::download(new ExportExcel($request),'students.xlsx');
        }

        elseif($viewType == 'payments'){
            return Excel::download(new ExportExcel($request),'payments.xlsx');
        }

        elseif($viewType == 'attendance'){
            return Excel::download(new ExportExcel($request),'attendance.xlsx');
        }

        elseif($viewType== 'instructors'){
            return Excel::download(new ExportExcel($request),'instructors.xlsx');
        }

    }
}
