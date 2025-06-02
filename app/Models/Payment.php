<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'month',
        'year',
        'amount',
        'payment_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getMonthNameAttribute()
    {
        return \Carbon\Carbon::create()->month($this->month)->translatedFormat('F');
    }
}
