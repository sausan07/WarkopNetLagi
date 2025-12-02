<div class="relative" wire:click.outside="close">

    <button wire:click="toggle" class="flex items-center gap-2">
        @if($user->image)
            <img 
                src="{{ asset('storage/' . $user->image) }}"
                class="w-9 h-9 rounded-full object-cover border shadow-sm"
            />
        @else
            <div 
                class="w-9 h-9 rounded-full bg-black text-white flex items-center justify-center font-bold text-sm shadow-sm">
                {{ strtoupper(substr($user->username, 0, 2)) }}
            </div>
        @endif

        <span class="hidden sm:inline font-semibold">
            {{ $user->username }}
        </span>
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 text-[#373737]"
             fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    @if($open)
        <div class="absolute right-0 top-14 bg-white border border-[#FFB347]/50 rounded-xl shadow-lg w-44 overflow-hidden">

            <a href="{{ route('profile', $user->username) }}" 
               class="block px-4 py-3 text-sm hover:bg-[#FFF2DD]">
               👤 Profil Saya
            </a>

            @if($user->isAdmin())
                <a href="{{ url('/admin') }}" 
                   class="block px-4 py-3 text-sm hover:bg-[#FFF2DD]">
                   ⚙️ Admin Panel
                </a>
            @endif

            <hr class="border-[#FFB347]/30">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full text-left block px-4 py-3 text-sm text-[#EB5160] hover:bg-[#FFF2DD]">
                    🚪 Logout
                </button>
            </form>

        </div>
    @endif

</div>
