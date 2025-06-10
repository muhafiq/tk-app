<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['event_name', 'description', 'date', 'created_by', 'type'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

    public function subactivities()
    {
        return $this->hasMany(EventSubactivity::class);
    }
}
