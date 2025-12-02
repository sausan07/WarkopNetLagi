<nav class="sticky top-0 bg-[#FFFAF0] border-b border-[#FFB347] shadow-sm z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">

        <a href="{{ route('home') }}" class="text-2xl font-bold font-utama text-[#373737]">WarkopNet</a>

        <div class="flex items-center gap-4 relative">
            @auth
                
                <a href="{{ route('threads.create') }}" title="Buat Diskusi Baru" class="hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#EB5160]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </a>

                
                @livewire('navbar-profile')


            @else
                <a href="{{ route('login') }}" class="bg-[#373737] hover:bg-[#FF6EC7] rounded-xl px-4 py-2 font-bold text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="bg-[#373737] hover:bg-[#FF6EC7] rounded-xl px-4 py-2 font-bold text-white transition-colors">Register</a>
            @endauth
        </div>
    </div>
</nav>
