<?php

namespace App\Services;

use App\Models\Classroom;

class ClassroomAllocator
{
    public static function getAvailableClassroomId(): ?int
    {
        return Classroom::withCount('students')
            ->orderBy('id')
            ->get()
            ->firstWhere(fn($room) => $room->students_count < $room->capacity)
            ?->id;
    }
}
