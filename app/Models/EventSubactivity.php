<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventSubactivity extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'title', 'description'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function images()
    {
        return $this->hasMany(EventImage::class, 'event_subactivity_id');
    }
}
