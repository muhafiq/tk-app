<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\UserTeacherSeeder;
use Database\Seeders\UserAdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserAdminSeeder::class,
            UserTeacherSeeder::class,
            TeacherSeeder::class,
            ClassroomSeeder::class,
        ]);
    }
}
