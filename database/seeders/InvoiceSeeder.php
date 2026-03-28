<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices=[
            [
                'student_id'=>'1',
                'course_id'=> '1',
                'total_amount'=> '3000',
            ],
            [
                'student_id'=>'2',
                'course_id'=> '2',
                'total_amount'=> '4000',
            ],
            [
                'student_id'=>'3',
                'course_id'=> '3',
                'total_amount'=> '2500',
            ],
            [
                'student_id'=>'4',
                'course_id'=> '4',
                'total_amount'=> '2000',
            ],
            [
                'student_id'=>'5',
                'course_id'=> '5',
                'total_amount'=> '5000',
            ],
            [
                'student_id'=>'5',
                'course_id'=> '1',
                'total_amount'=> '3000',
            ],
            [
                'student_id'=>'5',
                'course_id'=> '2',
                'total_amount'=> '4000',
            ],
            [
                'student_id'=>'5',
                'course_id'=> '3',
                'total_amount'=> '2500',
            ],
            [
                'student_id'=>'5',
                'course_id'=> '4',
                'total_amount'=> '2000',
            ],
            [
                'student_id'=>'4',
                'course_id'=> '5',
                'total_amount'=> '5000',
            ],
            [
                'student_id'=>'4',
                'course_id'=> '1',
                'total_amount'=> '3000',
            ],
            [
                'student_id'=>'4',
                'course_id'=> '2',
                'total_amount'=> '4000',
            ],
            [
                'student_id'=>'4',
                'course_id'=> '3',
                'total_amount'=> '2500',
            ],


        ];

        foreach ($invoices as $invoice)
            Invoice::create($invoice);
    }
}
