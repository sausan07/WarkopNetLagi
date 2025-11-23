<div>
    <h2 class="text-2xl font-bold text-[#373737] mb-6">
        Diikuti oleh {{ $user->name }}
    </h2>

    <div class="space-y-4">
        @forelse($user->followers as $follower)
            <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-start gap-4">
                    
                    <!-- Foto profil -->
<a href="{{ route('profile', $follower->username) }}">
    @if($follower->image)
        <img 
            src="{{ asset('storage/' . $follower->image) }}"
            class="w-14 h-14 rounded-full object-cover border shadow-sm hover:scale-105 transition" 
        />
    @else
        <div 
            class="w-14 h-14 rounded-full bg-[#373737] text-white 
                   flex items-center justify-center font-bold text-lg 
                   shadow-sm hover:scale-105 transition">
            {{ strtoupper(substr($follower->name, 0, 2)) }}
        </div>
    @endif
</a>


                    <div class="flex-1">
                        <!-- Nama -->
                        <a href="{{ route('profile', $follower->username) }}" 
                           class="text-lg font-bold text-[#373737] hover:text-[#EB5160]">
                            {{ $follower->name }}
                        </a>

                        <!-- Username -->
                        <div class="text-sm text-[#555]">
                            {{ '@' . $follower->username }}
                        </div>

                        <!-- Bio singkat -->
                        @if ($follower->bio)
                            <p class="text-[#555] mt-2 text-sm line-clamp-2">
                                {{ Str::limit($follower->bio, 80) }}
                            </p>
                        @endif

                        <!-- Extra info -->
                        <div class="flex gap-4 items-center text-[#555] text-sm mt-3">
                            <span>📌 {{ $follower->threads->count() }} Diskusi</span>
                            <span>💬 {{ $follower->posts->count() }} Balasan</span>
                        </div>
                    </div>

                </div>
            </article>
        @empty
            <p class="text-center text-gray-500 py-8">Belum memiliki pengikut.</p>
        @endforelse
    </div>
</div>
