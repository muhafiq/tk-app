<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'category',
        'description',
        'amount',
        'date',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
