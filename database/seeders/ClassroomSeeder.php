<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\Teacher;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $classNames = ['Kelas A', 'Kelas B', 'Kelas C', 'Kelas D', 'Kelas E'];

        // Ambil 5 guru pertama
        $teachers = Teacher::take(5)->get();

        foreach ($classNames as $i => $name) {
            Classroom::create([
                'capacity' => 15,
                'location' => '1.' . ($i + 1),
                'type' => 'kelas',
                'wali_kelas' => $teachers[$i]->id ?? null,
            ]);
        }
    }
}
