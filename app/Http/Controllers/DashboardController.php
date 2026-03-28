<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Student;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
         // إحصائيات عامة
    $stats = [
        'instructors_count' => Instructor::count(),
        'students_count' => Student::count(),
        'courses_count' => Course::count(),
        'users_count' => User::count(),
        'invoices_count' => Invoice::count(),
        'invoices_total' => Invoice::sum('total_amount'),
        'invoices_paid' => Invoice::where('status','مدفوعة')->sum('total_amount'),
        'invoices_partial' => Invoice::where('status','مدفوعة جزئيا')->sum('total_amount'),
        'invoices_unpaid' => Invoice::where('status','غير مدفوعة')->sum('total_amount'),
    ];

    // آخر 5 فواتير
    $latestInvoices = Invoice::with('student')->latest()->take(5)->get();

    // نسبة المدفوعات
    $totalInvoices = $stats['invoices_total'] ?: 1; // لتجنب القسمة على صفر
    $paidPercentage = ($stats['invoices_paid'] / $totalInvoices) * 100;
    $partialPercentage = ($stats['invoices_partial'] / $totalInvoices) * 100;
    $unpaidPercentage = ($stats['invoices_unpaid'] / $totalInvoices) * 100;

    return view('dashboard', compact(
        'stats',
        'latestInvoices',
        'paidPercentage',
        'partialPercentage',
        'unpaidPercentage'
    ));
    }
}
