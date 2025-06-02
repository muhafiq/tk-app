<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'gender', 'religion', 'address', 'kartu_keluarga',
        'akta_kelahiran', 'spesific_desease', 'birth_place',
        'parent_id', 'class_id',
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'student_event')->withPivot('teacher_notes')->withTimestamps();
    }
}
