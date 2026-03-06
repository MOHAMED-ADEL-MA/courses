<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'total_amount',
        'status',

    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function getRemainingAmountAttribute(){
        $paidAmount = $this->payments->sum('amount');
        return $this->total_amount - $paidAmount;
    }
}
