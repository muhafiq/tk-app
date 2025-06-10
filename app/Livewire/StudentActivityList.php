<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class StudentActivityList extends Component
{
    public function render()
    {
        $events = Event::with(['images', 'creator', 'subactivities.images'])->orderBy('date', 'desc')->get();

        return view('livewire.student-activity-list', [
            'events' => $events
        ]);
    }
}
