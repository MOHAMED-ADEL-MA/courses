<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'courceSession_id',
        'student_id',
        'status',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function courseSession(){
        return $this->belongsTo(CourseSession::class);
    }
}
