<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Thread;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $admin = User::create([
            'name' => 'Admin WarkopNet',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'user_role' => 'admin',
            'bio' => 'Admin WarkopNet',
            'password' => bcrypt('password'),
        ]);

       
        $user1 = User::create([
            'name' => 'Sausan',
            'username' => 'sausan',
            'email' => 'sausan@gmail.com',
            'user_role' => 'member',
            'bio' => 'Pecinta movie',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::create([
            'name' => 'Seokmin',
            'username' => 'itsDk',
            'email' => 'dk@gmail.com',
            'user_role' => 'member',
            'bio' => 'Sang pujaan',
            'password' => bcrypt('password'),
        ]);

        $user3 = User::create([
            'name' => 'Asma',
            'username' => 'asma',
            'email' => 'asma@gmail.com',
            'user_role' => 'member',
            'bio' => 'Nama kakaku',
            'password' => bcrypt('password'),
        ]);

       
        $categories = [
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Pemrograman', 'slug' => 'pemrograman'],
            ['name' => 'Bisnis', 'slug' => 'bisnis'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle'],
            ['name' => 'Gaming', 'slug' => 'gaming'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
        ];
    }
}
