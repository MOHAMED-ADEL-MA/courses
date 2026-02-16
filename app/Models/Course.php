<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'hours',
        'start_date',
        'end_date',
        'instructor_id'
    ];

    protected $casts = [
        'start_date'=>'date',
        'end_date'=>'date'

    ];

    public function students(){
        return $this->belongsToMany(Student::class, 'student_course')
                ->withTimestamps();
    }

    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function courseSessions(){
        return $this->hasMany(CourseSession::class);
    }


}
