<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'birth_date',
        'photo',
        'registration_date'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'registration_date' => 'date'
    ];

    public function getAgeAttribute(){
        if($this->birth_date)
            return $this->birth_date->age . ' سنه';

        return '-';
    }

    public function courses(){
        return $this->belongsToMany(Course::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
