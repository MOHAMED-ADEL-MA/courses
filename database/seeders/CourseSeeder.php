<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses=[
            [
                'name'=>'Laravel',
                'description'=>'No Description',
                'price'=> '3000',
                'hours'=> '15',
                'start_date'=> '2026-10-01',
                'end_date'=> '2026-11-01',
                'instructor_id'=> '1',
            ],
            [
                'name'=>'security',
                'description'=>'No Description',
                'price'=> '4000',
                'hours'=> '25',
                'start_date'=> '2026-07-01',
                'end_date'=> '2026-09-03',
                'instructor_id'=> '5',
            ],
            [
                'name'=>'Project Managment',
                'description'=>'No Description',
                'price'=> '2500',
                'hours'=> '10',
                'start_date'=> '2026-04-15',
                'end_date'=> '2026-07-20',
                'instructor_id'=> '2',
            ],
            [
                'name'=>'Flutter',
                'description'=>'No Description',
                'price'=> '2000',
                'hours'=> '14',
                'start_date'=> '2026-05-01',
                'end_date'=> '2026-07-03',
                'instructor_id'=> '4',
            ],
            [
                'name'=>'System Analysis',
                'description'=>'No Description',
                'price'=> '5000',
                'hours'=> '21',
                'start_date'=> '2026-11-14',
                'end_date'=> '2027-01-01',
                'instructor_id'=> '3',
            ],
        ];

        foreach($courses as $course)
            Course::create($course);
    }
}
