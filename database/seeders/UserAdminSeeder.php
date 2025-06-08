<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'name' => 'Admin',
                'phone_number' => '082313074450',
                'password' => Hash::make('admin-123'),
                'role' => 'admin',
            ]
        );
    }
}
