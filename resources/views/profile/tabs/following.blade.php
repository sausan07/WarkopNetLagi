<div>
    <h2 class="text-2xl font-bold text-[#373737] mb-6">
        Diikuti oleh {{ $user->name }}
    </h2>

    <div class="space-y-4">
        @forelse($user->following as $follow)
            <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-start gap-4">
                    
                    <!-- Foto profil / Inisial -->
<a href="{{ route('profile', $follow->username) }}">
    @if ($follow->image)
        <img 
            src="{{ asset('storage/' . $follow->image) }}"
            class="w-14 h-14 rounded-full object-cover border shadow-sm hover:scale-105 transition" 
        />
    @else
        <div 
            class="w-14 h-14 rounded-full bg-[#373737] text-white 
                   flex items-center justify-center font-bold text-lg 
                   shadow-sm hover:scale-105 transition">
            {{ strtoupper(substr($follow->username, 0, 2)) }}
        </div>
    @endif
</a>


                    <div class="flex-1">
                        <a href="{{ route('profile', $follow->username) }}" 
                           class="text-lg font-bold text-[#373737] hover:text-[#EB5160]">
                            {{ $follow->name }}
                        </a>

                        <div class="text-sm text-[#555]">
                            {{ '@' . $follow->username }}
                        </div>

                        @if ($follow->bio)
                            <p class="text-[#555] mt-2 text-sm line-clamp-2">
                                {{ Str::limit($follow->bio, 80) }}
                            </p>
                        @endif

                        <div class="flex gap-4 items-center text-[#555] text-sm mt-3">
                            <span>📌 {{ $follow->threads->count() }} Diskusi</span>
                            <span>💬 {{ $follow->posts->count() }} Balasan</span>
                        </div>
                    </div>

                </div>
            </article>
        @empty
            <p class="text-center text-gray-500 py-8">Tidak mengikuti siapa pun.</p>
        @endforelse
    </div>
</div>
