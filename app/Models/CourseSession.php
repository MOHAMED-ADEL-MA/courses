<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    protected $fillable = [
        'name',
        'course_id',
        'date',
        'time',
        'hall',
        'status'
    ];

    protected $casts = [
        'date'=>'date'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class,'courceSession_id');
    }
}
