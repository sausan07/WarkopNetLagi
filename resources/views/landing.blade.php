@extends('layouts.app')

@section('content')

<x-navbar />


<section id="home" class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center">
        <div class="order-2 lg:order-2 ring-4 ring-[#FFB347] rounded-2xl shadow-2xl overflow-hidden transition-transform duration-300 ease-in-out hover:scale-105">
            <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348" alt="Kopi & Komunitas" class="w-full h-64 sm:h-80 md:h-96 object-cover"/>
        </div>
        <div class="order-1 lg:order-1">
            <h1 class="text-5xl sm:text-6xl font-bold text-[#373737] font-utama leading-tight">
                Secangkir Kopi,<br><span class="text-[#FF6EC7]">Sejuta Koneksi.</span>
            </h1>
            <p class="mt-5 text-[#555] font-utama text-lg sm:text-xl leading-relaxed">
                Selamat datang di WarkopNet! Tempat di mana aroma kopi hangat bertemu dengan derasnya koneksi dan ide tanpa batas. Yuk, nikmati secangkir kopi sejuta koneksi bersama kami!
            </p>
            <div class="mt-6 flex flex-wrap items-center gap-4">
                @auth
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-xl bg-[#FFB347] hover:bg-[#FF6EC7] text-white px-6 py-3 text-2xl transition-transform duration-300 ease-in-out hover:scale-105">Lihat Diskusi</a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-[#FFB347] hover:bg-[#FF6EC7] text-white px-6 py-3 text-2xl transition-transform duration-300 ease-in-out hover:scale-105">Mulai Diskusi</a>
                @endauth
            </div>
        </div>
    </div>
</section>


<section id="categories" class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold font-utama text-[#373737] underline underline-offset-8 decoration-[#FFB347] decoration-4 uppercase tracking-widest">Categories</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $categories = [
                ['name' => 'Teknologi', 'icon' => 'fa-desktop', 'color' => '#FF6EC7'],
                ['name' => 'Pemrograman', 'icon' => 'fa-code', 'color' => '#FFB347'],
                ['name' => 'Bisnis', 'icon' => 'fa-briefcase', 'color' => '#373737'],
                ['name' => 'Lifestyle', 'icon' => 'fa-heart', 'color' => '#FF6EC7'],
                ['name' => 'Gaming', 'icon' => 'fa-gamepad', 'color' => '#FFB347'],
                ['name' => 'Olahraga', 'icon' => 'fa-futbol', 'color' => '#373737'],
            ];
            @endphp
            
            @foreach($categories as $category)
            <div class="rounded-2xl bg-[#FFFAF0] shadow-xl p-6 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 grid rounded-full text-white place-items-center text-xl" style="background-color: {{ $category['color'] }}">
                        <i class="fa-solid {{ $category['icon'] }}"></i>
                    </div>
                    <h3 class="font-utama text-xl font-bold text-[#373737]">{{ $category['name'] }}</h3>
                </div>
                <p class="text-[#555] text-sm">Diskusi tentang {{ strtolower($category['name']) }} dan topik terkait</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section id="features" class="py-20 bg-[#FFFAF0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold font-utama text-[#373737] underline underline-offset-8 decoration-[#FFB347] decoration-4 uppercase tracking-widest">Fitur Unggulan</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $features = [
                ['icon' => '💬', 'title' => 'Diskusi Real-time', 'desc' => 'Balas dan diskusikan topik favorit Anda'],
                ['icon' => '❤️', 'title' => 'Like & Bookmark', 'desc' => 'Simpan postingan favorit untuk dibaca nanti'],
                ['icon' => '👥', 'title' => 'Follow Pengguna', 'desc' => 'Ikuti pengguna dan dapatkan update mereka'],
                ['icon' => '🔍', 'title' => 'Pencarian Cerdas', 'desc' => 'Temukan diskusi dengan mudah'],
                ['icon' => '🚨', 'title' => 'Laporan Konten', 'desc' => 'Laporkan konten yang tidak pantas'],
                ['icon' => '📤', 'title' => 'Share ke Sosmed', 'desc' => 'Bagikan diskusi ke platform sosial media'],
            ];
            @endphp
            
            @foreach($features as $feature)
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-shadow">
                <div class="text-4xl mb-3">{{ $feature['icon'] }}</div>
                <h3 class="font-utama text-xl font-bold text-[#373737] mb-2">{{ $feature['title'] }}</h3>
                <p class="text-[#555]">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


<footer class="bg-[#373737] text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="font-utama text-lg">&copy; 2025 WarkopNet. Secangkir Kopi, Sejuta Koneksi.</p>
        <p class="text-sm mt-2 text-gray-400">Dibuat dengan ❤️ menggunakan Laravel & Livewire</p>
    </div>
</footer>
@endsection
