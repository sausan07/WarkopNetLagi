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
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin WarkopNet',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'user_role' => 'admin',
            'bio' => 'Admin WarkopNet',
            'password' => bcrypt('password'),
        ]);

        // Create Regular Users
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

        // Create Categories
        $categories = [
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Pemrograman', 'slug' => 'pemrograman'],
            ['name' => 'Bisnis', 'slug' => 'bisnis'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle'],
            ['name' => 'Gaming', 'slug' => 'gaming'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Threads
        $thread1 = Thread::create([
            'title' => 'Tips Belajar Laravel untuk Pemula',
            'content' => 'Halo semua! Saya mau share pengalaman belajar Laravel dari nol. Laravel adalah framework PHP yang sangat powerful dan mudah dipelajari jika kita tahu caranya...',
            'user_id' => $user1->id,
            'category_id' => 2, // Pemrograman
        ]);

        $thread2 = Thread::create([
            'title' => 'Rekomendasi Laptop untuk Programming 2024',
            'content' => 'Halo teman-teman developer! Saya lagi cari laptop baru untuk coding. Budget sekitar 15 juta. Ada rekomendasi?',
            'user_id' => $user2->id,
            'category_id' => 1, // Teknologi
        ]);

        $thread3 = Thread::create([
            'title' => 'Cara Memulai Bisnis Online dari Nol',
            'content' => 'Share dong pengalaman kalian memulai bisnis online. Saya tertarik untuk mulai tapi masih bingung harus mulai dari mana...',
            'user_id' => $user3->id,
            'category_id' => 3, // Bisnis
        ]);

        // Create Posts (Replies)
        $post1 = Post::create([
            'content' => 'Setuju banget! Laravel memang framework terbaik untuk PHP. Dokumentasinya lengkap dan komunitasnya aktif.',
            'user_id' => $user2->id,
            'thread_id' => $thread1->id,
            'status' => 'active',
        ]);

        $post2 = Post::create([
            'content' => 'Untuk budget segitu, saya rekomendasikan ThinkPad X1 Carbon atau MacBook Air M2. Keduanya sangat bagus untuk development.',
            'user_id' => $user1->id,
            'thread_id' => $thread2->id,
            'status' => 'active',
        ]);

        $post3 = Post::create([
            'content' => 'Mulai dari yang kecil dulu aja. Coba jualan di marketplace, pelajari marketing digital, dan konsisten.',
            'user_id' => $user1->id,
            'thread_id' => $thread3->id,
            'status' => 'active',
        ]);

        $post4 = Post::create([
            'content' => 'Jangan lupa belajar Livewire juga! Sangat memudahkan untuk bikin aplikasi yang interaktif tanpa banyak JavaScript.',
            'user_id' => $user3->id,
            'thread_id' => $thread1->id,
            'status' => 'active',
        ]);


    }
}
