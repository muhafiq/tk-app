<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [
            [
                'nip' => 1980123401,
                'gender' => 'L',
                'religion' => 'Islam',
                'address' => 'Jl. Kenari No.1',
                'joined_date' => '2010-07-15',
            ],
            [
                'nip' => 1981123402,
                'gender' => 'P',
                'religion' => 'Islam',
                'address' => 'Jl. Melati No.2',
                'joined_date' => '2012-01-10',
            ],
            [
                'nip' => 1979123403,
                'gender' => 'L',
                'religion' => 'Kristen',
                'address' => 'Jl. Cemara No.3',
                'joined_date' => '2008-05-20',
            ],
            [
                'nip' => 1985123404,
                'gender' => 'P',
                'religion' => 'Katolik',
                'address' => 'Jl. Mawar No.4',
                'joined_date' => '2014-11-01',
            ],
            [
                'nip' => 1983123405,
                'gender' => 'L',
                'religion' => 'Islam',
                'address' => 'Jl. Anggrek No.5',
                'joined_date' => '2011-03-08',
            ],
        ];

        $users = User::where('role', 'teacher')->get();

        foreach ($users as $index => $user) {
            Teacher::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'nip' => $profiles[$index]['nip'],
                'gender' => $profiles[$index]['gender'],
                'religion' => $profiles[$index]['religion'],
                'address' => $profiles[$index]['address'],
                'joined_date' => $profiles[$index]['joined_date'],
            ]);
        }
    }
}
