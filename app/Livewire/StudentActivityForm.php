<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\EventSubactivity;
use Illuminate\Support\Facades\Auth;

class StudentActivityForm extends Component
{
    use WithFileUploads;

    public array $form = [
        'event_name' => '',
        'description' => '',
        'date' => '',
        'type' => '',
    ];

    public array $subactivities = [];

    public function mount()
    {
        $this->addSubactivity(); // Awal satu sub kegiatan default
    }

    public function addSubactivity()
    {
        $this->subactivities[] = [
            'title' => '',
            'description' => '',
            'photos' => [],
        ];
    }

    public function removeSubactivity($index)
    {
        unset($this->subactivities[$index]);
        $this->subactivities = array_values($this->subactivities); // Re-index
    }

    public function submitActivityForm()
    {
        $this->validate([
            'form.event_name' => 'required|string',
            'form.description' => 'required|string',
            'form.date' => 'required|date',
            'form.type' => 'required|in:class,school',
            'subactivities.*.title' => 'required|string',
            'subactivities.*.description' => 'required|string',
            'subactivities.*.photos.*' => 'nullable|image|max:10240',
        ]);

        $event = Event::create([
            'event_name' => $this->form['event_name'],
            'description' => $this->form['description'],
            'date' => $this->form['date'],
            'type' => $this->form['type'],
            'created_by' => Auth::id(),
        ]);

        foreach ($this->subactivities as $sub) {
            $subactivity = EventSubactivity::create([
                'event_id' => $event->id,
                'title' => $sub['title'],
                'description' => $sub['description'],
            ]);

            if (!empty($sub['photos'])) {
                foreach ($sub['photos'] as $photo) {
                    $path = $photo->store('student_event', 'public');
                    EventImage::create([
                        'event_id' => $event->id,
                        'event_subactivity_id' => $subactivity->id,
                        'image_url' => $path,
                    ]);
                }
            }
        }

        session()->flash('message', 'Kegiatan dan sub kegiatan berhasil disimpan!');
        $this->reset(['form', 'subactivities']);
        $this->addSubactivity(); // reset dengan 1 sub
    }

    public function render()
    {
        return view('livewire.student-activity-form');
    }
}