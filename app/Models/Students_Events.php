<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class students_events extends Model
{
    use HasFactory;

    protected $fillable = [
        'Student_ID',
        'Event_ID',
        'Teacher_Notes'
    ];
}
