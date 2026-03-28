<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Instructor::factory(10)->create();
        $instructors=[
            [
                'name'=>'Prof. Wilmer Greenfelder PhD',
                'phone'=> '585.394.6009',
                'email'=> 'steuber.furman@example.com',
                'specialization'=> 'Web Development',
                'experience_years'=> '6',
                ],
            [
                'name'=>'Prof. Tyrel Wolff IV',
                'phone'=> '229.860.1607',
                'email'=> 'frodriguez@example.com',
                'specialization'=> 'Project Managment',
                'experience_years'=> '7',
                ],
            [
                'name'=>'Prof. charly Greenfelder ',
                'phone'=> '662.394.6009',
                'email'=> 'chak.grman@example.com',
                'specialization'=> 'Data Analysis',
                'experience_years'=> '2',
                ],
            [
                'name'=>'Prof. Margaretta Metz',
                'phone'=> '(432) 324-8482',
                'email'=> 'vdach@example.com',
                'specialization'=> 'Mobile Apps',
                'experience_years'=> '8',
                ],
            [
                'name'=>'Prof. Haylee Corwin',
                'phone'=> '564-666-4898',
                'email'=> 'jeanette.mckenzie@example.net',
                'specialization'=> 'Cyber Security',
                'experience_years'=> '5',
                ],
        ];

        foreach($instructors as $instructor)
            Instructor::create($instructor);
    }
}
