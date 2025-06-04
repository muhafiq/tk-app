<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'religion',
        'address',
        'kartu_keluarga',
        'akta_kelahiran',
        'spesific_desease',
        'birth_date',
        'birth_place',
        'nation',
        'parent_id',
        'class_id',
        'disabled'
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
