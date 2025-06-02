<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['event_name', 'description', 'date', 'created_by'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_event')->withPivot('teacher_notes')->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'created_by');
    }
}
