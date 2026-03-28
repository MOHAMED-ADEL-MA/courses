<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Student::factory()->count(10)->create();
        $students=[
            [
                'name'=>'Rahsaan VonRueden',
                'phone'=> '1-762-751-6314',
                'email'=> 'ypollich@example.com',
                'birth_date'=> '2005-01-13',
                'photo'=> '',
                'registration_date'=> '2015-05-12',
            ],
            [
                'name'=>'Sierra Fay',
                'phone'=> '281.439.4399',
                'email'=> 'markus19@example.net',
                'birth_date'=> '2000-02-06',
                'photo'=> '',
                'registration_date'=> '2016-03-25',
            ],
            [
                'name'=>'Mathias Schroeder',
                'phone'=> '+1.267.207.2312',
                'email'=> 'corwin.chelsea@example.org',
                'birth_date'=> '2007-09-09',
                'photo'=> '',
                'registration_date'=> '2019-12-03',
            ],
            [
                'name'=>'Efrain Cremin',
                'phone'=> '+1-909-869-9409',
                'email'=> 'winona.littel@example.net',
                'birth_date'=> '1995-12-08',
                'photo'=> '',
                'registration_date'=> '2015-10-07',
            ],
            [
                'name'=>'Miss Delfina Schmeler III',
                'phone'=> '(520) 986-6041',
                'email'=> 'shanelle44@example.net',
                'birth_date'=> '1985-03-15',
                'photo'=> '',
                'registration_date'=> '2012-08-04',
            ],
        ];
        foreach ($students as $student)
            Student::create($student);
    }
}
