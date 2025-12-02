<div>
    <h2 class="text-2xl font-bold text-[#373737] mb-6">
        Balasan oleh {{ $user->name }}
    </h2>


<div class="space-y-4">
    @forelse($user->posts as $post)
        <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg">
            <div class="mb-2 flex items-center justify-between">
                <a href="{{ route('threads.show', $post->thread->slug) }}" class="text-sm text-[#EB5160] hover:underline">
                    Re: {{ $post->thread->title }}
                </a>
                <span class="text-xs text-[#555]">{{ $post->created_at->diffForHumans() }}</span>
            </div>
          <p class="text-[#555]">
    {!! Str::limit(strip_tags($post->content, '<strong><em><u><a><br><ul><ol><li>'), 200) !!}
</p>

        </article>
    @empty
        <p class="text-center text-gray-500 py-8">Belum ada balasan yang dibuat.</p>
    @endforelse
</div>


</div>
