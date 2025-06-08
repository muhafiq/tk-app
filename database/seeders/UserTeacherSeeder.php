<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Ahmad Ramdhan',    'phone' => '0811000001'],
            ['name' => 'Siti Marlina',     'phone' => '0811000002'],
            ['name' => 'Bambang Irawan',   'phone' => '0811000003'],
            ['name' => 'Maria Kristina',   'phone' => '0811000004'],
            ['name' => 'Rizky Permana',    'phone' => '0811000005'],
        ];

        foreach ($teachers as $teacher) {
            User::create([
                'name'         => $teacher['name'],
                'phone_number' => $teacher['phone'],
                'password'     => Hash::make('password'), // default password
                'role'         => 'teacher',
            ]);
        }
    }
}
