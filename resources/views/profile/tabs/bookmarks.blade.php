<div>
    <h2 class="text-2xl font-bold text-[#373737] mb-6">
        Bookmark oleh {{ $user->name }}
    </h2>


<div class="space-y-4">
    @forelse($user->bookmarks as $bookmark)
        @if($bookmark->thread_id && $bookmark->thread)
            <article class="relative bg-[#FFFAF0] p-5 rounded-2xl shadow-lg hover:shadow-xl transition-shadow border-l-4 border-[#FFB347]">
                <!-- Tombol Unbookmark di pojok kanan atas -->
                <div class="absolute top-2 right-2">
                    @livewire('bookmark-button', ['threadId' => $bookmark->thread->id], key('thread-'.$bookmark->thread->id))
                </div>

                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <span class="text-xs bg-[#FFB347] text-white px-2 py-1 rounded-full">Thread</span>
                        <a href="{{ route('threads.show', $bookmark->thread->slug) }}" class="text-lg font-bold text-[#373737] hover:text-[#EB5160] block mt-2">
                            {{ $bookmark->thread->title }}
                        </a>
                        <span class="text-xs text-[#555] block mt-1">
                            Disimpan {{ $bookmark->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
                <p class="text-[#555] mb-4 line-clamp-2">{{ Str::limit($bookmark->thread->content, 150) }}</p>
            </article>
        @elseif($bookmark->post_id && $bookmark->post && $bookmark->post->thread)
            <article class="relative bg-[#FFFAF0] p-5 rounded-2xl shadow-lg border-l-4 border-[#FF6EC7]">
                <div class="absolute top-2 right-2">
                    @livewire('bookmark-button', ['postId' => $bookmark->post->id], key('post-'.$bookmark->post->id))
                </div>

                <div class="mb-2">
                    <span class="text-xs bg-[#FF6EC7] text-white px-2 py-1 rounded-full">Comment</span>
                    <a href="{{ route('threads.show', $bookmark->post->thread->slug) }}" class="text-sm text-[#EB5160] hover:underline block mt-2">
                        Re: {{ $bookmark->post->thread->title }}
                    </a>
                    <span class="text-xs text-[#555] ml-2">Disimpan {{ $bookmark->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-[#555]">{{ Str::limit($bookmark->post->content, 200) }}</p>
            </article>
        @else
            <article class="bg-gray-100 p-5 rounded-2xl shadow-lg border-l-4 border-gray-400 opacity-60">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <span class="text-xs bg-gray-400 text-white px-2 py-1 rounded-full">
                            {{ $bookmark->thread_id ? 'Thread' : 'Comment' }}
                        </span>
                        <p class="text-sm text-gray-600 mt-2 italic">
                            {{ $bookmark->thread_id ? 'Thread telah dihapus' : 'Komentar telah dihapus' }}
                        </p>
                        <span class="text-xs text-gray-500 block mt-1">
                            Disimpan {{ $bookmark->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </article>
        @endif
    @empty
        <p class="text-center text-gray-500 py-8">Belum ada bookmark yang disimpan.</p>
    @endforelse
</div>


</div>
