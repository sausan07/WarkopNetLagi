


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

              
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
                        <div class="w-9 h-9 rounded-full bg-[#373737] text-white flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                        </div>
                        <span class="hidden sm:inline font-semibold">{{ auth()->user()->username }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#373737]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                 
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute right-0 top-14 bg-white border border-[#FFB347]/50 rounded-xl shadow-lg w-44 overflow-hidden">
                        <a href="{{ route('profile', auth()->user()->username) }}" class="block px-4 py-3 text-sm hover:bg-[#FFF2DD]">👤 Profil Saya</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ url('/admin') }}" class="block px-4 py-3 text-sm hover:bg-[#FFF2DD]">⚙️ Admin Panel</a>
                        @endif
                        <hr class="border-[#FFB347]/30">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-3 text-sm text-[#EB5160] hover:bg-[#FFF2DD]">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-[#373737] hover:bg-[#FF6EC7] rounded-xl px-4 py-2 font-bold text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="bg-[#373737] hover:bg-[#FF6EC7] rounded-xl px-4 py-2 font-bold text-white transition-colors">Register</a>
            @endauth
        </div>
    </div>
</nav>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
