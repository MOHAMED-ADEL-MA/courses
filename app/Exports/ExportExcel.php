<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Instructor;
use App\Models\Invoice;
use App\Models\Student;
use illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportExcel implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request=$request;
    }

    public function view(): View{
        $viewType = $this->request->input('view', 'students');

        if ($viewType== 'students'){
            $students=Student::with('courses')
            ->when($this->request->course_id,fn($q)=>
                $q->whereHas('courses',fn($q2)=>
                    $q2->where('course_id',$this->request->course_id)))->get();
            return view('reports.excel', compact('students','viewType'));
        }

        elseif ($viewType== 'payments'){
            $payments=Invoice::with('student','course')
            ->when($this->request->course_id,fn($q)=>
                $q->whereHas('course',fn($q2)=>
                    $q2->where('course_id',$this->request->course_id)))
            ->when($this->request->status,fn($q)=>
                $q->where('status',$this->request->status))->get();
            return view('reports.excel', compact('payments','viewType'));
        }

        elseif($viewType == 'attendance'){
            $attendances=Attendance::with('student','courseSession')
                ->when($this->request->course_id,fn($q)=>
                    $q->whereHas('courseSession',fn($q2)=>
                        $q2->where('course_id',$this->request->course_id)))
                ->when($this->request->date_from,fn($q)=>
                    $q->whereHas('courseSession',fn($q2)=>
                        $q2->where('date',$this->request->date_from)))->get();
            return view('reports.excel',compact('attendances','viewType'));
        }

        else{
            $instructors=Instructor::with('courses')->get();
            return view('reports.excel', compact('instructors','viewType'));
        }
    }
}
