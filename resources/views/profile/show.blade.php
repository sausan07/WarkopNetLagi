@extends('layouts.app')

@section('content')

<x-navbar />


<section class="py-12">
    <div class="max-w-4xl mx-auto bg-[#FFFAF0] rounded-2xl shadow-xl p-8 border border-[#FFB347]/40">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" class="w-28 h-28 rounded-full border-4 border-[#FFB347] object-cover" alt="{{ $user->name }}">
            @else
                <div class="w-28 h-28 rounded-full border-4 border-[#FFB347] bg-[#373737] text-white flex items-center justify-center text-4xl font-bold">
                    {{ strtoupper(substr($user->username, 0, 2)) }}
                </div>
            @endif

            <div class="flex-1 text-center sm:text-left">
                <h1 class="text-3xl font-bold text-[#373737]">{{ $user->name }}</h1>
                <p class="text-[#555] mt-1 font-accent">&#64;{{ $user->username }}</p>
                @if($user->bio)
                    <p class="text-[#555] mt-2 font-accent">{{ $user->bio }}</p>
                @endif
                
                <div class="flex flex-wrap justify-center sm:justify-start gap-6 mt-4 text-[#373737]">
                    <span><b>{{ $user->followers->count() }}</b> Pengikut</span>
                    <span><b>{{ $user->following->count() }}</b> Mengikuti</span>
                    <span><b>{{ $user->threads->count() }}</b> Diskusi</span>
                    <span><b>{{ $user->posts->count() }}</b> Balasan</span>
                </div>

                <div class="mt-4 flex gap-3 justify-center sm:justify-start">
                    @if(auth()->check() && auth()->id() === $user->id)
                      
                        <a href="{{ route('profile.edit', $user->username) }}" 
                           class="px-6 py-2 rounded-xl bg-[#FFB347] hover:bg-[#FF6EC7] text-white font-bold transition-all duration-300">
                            ✏️ Edit Profil
                        </a>
                    @else
                    

                        @livewire('follow-button', ['userId' => $user->id], key('follow-profile-'.$user->id))
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<section class="max-w-5xl mx-auto px-6 py-10" x-data="{ activeTab: 'threads' }">


    <div class="flex border-b border-[#FFB347]/40 mb-6 overflow-x-auto">
        <button @click="activeTab = 'threads'" 
                :class="activeTab === 'threads' ? 'border-[#FFB347] text-[#373737]' : 'border-transparent text-gray-500'"
                class="px-6 py-3 font-bold border-b-2 transition-colors whitespace-nowrap">
            📝 Diskusi ({{ $user->threads->count() }})
        </button>
        <button @click="activeTab = 'posts'" 
                :class="activeTab === 'posts' ? 'border-[#FFB347] text-[#373737]' : 'border-transparent text-gray-500'"
                class="px-6 py-3 font-bold border-b-2 transition-colors whitespace-nowrap">
            💬 Balasan ({{ $user->posts->count() }})
        </button>
        <button @click="activeTab = 'bookmarks'" 
                :class="activeTab === 'bookmarks' ? 'border-[#FFB347] text-[#373737]' : 'border-transparent text-gray-500'"
                class="px-6 py-3 font-bold border-b-2 transition-colors whitespace-nowrap">
            🔖 Bookmark ({{ $user->bookmarks->count() }})
        </button>
        @if(auth()->check() && auth()->id() === $user->id)
            <button @click="activeTab = 'reports'" 
                    :class="activeTab === 'reports' ? 'border-[#FFB347] text-[#373737]' : 'border-transparent text-gray-500'"
                    class="px-6 py-3 font-bold border-b-2 transition-colors whitespace-nowrap">
                🚩 Laporan ({{ $user->reports->count() }})
            </button>
        @endif
    </div>


    <div x-show="activeTab === 'threads'">
        <h2 class="text-2xl font-bold text-[#373737] mb-6">
            Diskusi oleh {{ $user->name }}
        </h2>

        <div class="space-y-4">
            @forelse($user->threads as $thread)
            <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <a href="{{ route('threads.show', $thread->slug) }}" class="text-lg font-bold text-[#373737] hover:text-[#EB5160]">
                            {{ $thread->title }}
                        </a>
                        <span class="text-xs text-[#555] block mt-1">
                            {{ $thread->created_at->diffForHumans() }} • #{{ $thread->category->name }}
                        </span>
                    </div>
                </div>
                <p class="text-[#555] mb-4 line-clamp-2">{{ Str::limit($thread->content, 150) }}</p>
                <div class="flex gap-4 items-center text-[#555] text-sm">
                    <span>💬 {{ $thread->posts->count() }} Balasan</span>
                </div>
            </article>
            @empty
            <p class="text-center text-gray-500 py-8">Belum ada diskusi yang dibuat.</p>
            @endforelse
        </div>
    </div>

 
    <div x-show="activeTab === 'posts'" x-cloak>
        <h2 class="text-2xl font-bold text-[#373737] mb-6">
            Balasan oleh {{ $user->name }}
        </h2>

        <div class="space-y-4">
            @forelse($user->posts as $post)
            <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg">
                <div class="mb-2">
                    <a href="{{ route('threads.show', $post->thread->slug) }}" class="text-sm text-[#EB5160] hover:underline">
                        Re: {{ $post->thread->title }}
                    </a>
                    <span class="text-xs text-[#555] ml-2">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-[#555]">{{ Str::limit($post->content, 200) }}</p>
            </article>
            @empty
            <p class="text-center text-gray-500 py-8">Belum ada balasan yang dibuat.</p>
            @endforelse
        </div>
    </div>


    <div x-show="activeTab === 'bookmarks'" x-cloak>
        <h2 class="text-2xl font-bold text-[#373737] mb-6">
            Bookmark oleh {{ $user->name }}
        </h2>

        <div class="space-y-4">
            @forelse($user->bookmarks as $bookmark)
                @if($bookmark->thread_id)
                    @if($bookmark->thread)
                     

                        <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg hover:shadow-xl transition-shadow border-l-4 border-[#FFB347]">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">

                                    <span class="text-xs bg-[#FFB347] text-white px-2 py-1 rounded-full">Thread</span>
                                    <a href="{{ route('threads.show', $bookmark->thread->slug) }}" class="text-lg font-bold text-[#373737] hover:text-[#EB5160] block mt-2">
                                        {{ $bookmark->thread->title }}
                                    </a>
                                    <span class="text-xs text-[#555] block mt-1">
                                        Disimpan {{ \Carbon\Carbon::parse($bookmark->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-[#555] mb-4 line-clamp-2">{{ Str::limit($bookmark->thread->content, 150) }}</p>
                        </article>
                    @else
                  
                        <article class="bg-gray-100 p-5 rounded-2xl shadow-lg border-l-4 border-gray-400 opacity-60">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <span class="text-xs bg-gray-400 text-white px-2 py-1 rounded-full">Thread</span>
                                    <p class="text-sm text-gray-600 mt-2 italic">Thread telah dihapus</p>
                                    <span class="text-xs text-gray-500 block mt-1">
                                        Disimpan {{ \Carbon\Carbon::parse($bookmark->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endif
                @elseif($bookmark->post_id)
                    @if($bookmark->post && $bookmark->post->thread)
                 
                        <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg border-l-4 border-[#FF6EC7]">
                            <div class="mb-2">
                                <span class="text-xs bg-[#FF6EC7] text-white px-2 py-1 rounded-full">Comment</span>
                                <a href="{{ route('threads.show', $bookmark->post->thread->slug) }}" class="text-sm text-[#EB5160] hover:underline block mt-2">
                                    Re: {{ $bookmark->post->thread->title }}
                                </a>
                                <span class="text-xs text-[#555] ml-2">Disimpan {{ \Carbon\Carbon::parse($bookmark->created_at)->diffForHumans() }}</span>
                            </div>
                            <p class="text-[#555]">{{ Str::limit($bookmark->post->content, 200) }}</p>
                        </article>
                    @else
                    
                        <article class="bg-gray-100 p-5 rounded-2xl shadow-lg border-l-4 border-gray-400 opacity-60">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <span class="text-xs bg-gray-400 text-white px-2 py-1 rounded-full">Comment</span>
                                    <p class="text-sm text-gray-600 mt-2 italic">Komentar telah dihapus</p>
                                    <span class="text-xs text-gray-500 block mt-1">
                                        Disimpan {{ \Carbon\Carbon::parse($bookmark->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endif
                @endif
            @empty
            <p class="text-center text-gray-500 py-8">Belum ada bookmark yang disimpan.</p>
            @endforelse
        </div>
    </div>



    @if(auth()->check() && auth()->id() === $user->id)
    <div x-show="activeTab === 'reports'" x-cloak>
        <h2 class="text-2xl font-bold text-[#373737] mb-6">
            Laporan oleh {{ $user->name }}
        </h2>

        <div class="space-y-4">
            @forelse($user->reports as $report)
                <article class="bg-[#FFFAF0] p-5 rounded-2xl shadow-lg border-l-4 
                    {{ $report->status === 'pending' ? 'border-yellow-500' : ($report->status === 'approved' ? 'border-green-500' : 'border-red-500') }}">
                    
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            @if($report->thread_id && $report->thread)
                                <span class="text-xs bg-[#FFB347] text-white px-2 py-1 rounded-full">Thread</span>
                                <a href="{{ route('threads.show', $report->thread->slug) }}" class="text-lg font-bold text-[#373737] hover:text-[#EB5160] block mt-2">
                                    {{ $report->thread->title }}
                                </a>
                            @elseif($report->post_id && $report->post && $report->post->thread)
                                <span class="text-xs bg-[#FF6EC7] text-white px-2 py-1 rounded-full">Comment</span>
                                <a href="{{ route('threads.show', $report->post->thread->slug) }}" class="text-sm text-[#EB5160] hover:underline block mt-2">
                                    Re: {{ $report->post->thread->title }}
                                </a>
                            @else
                                <span class="text-xs bg-gray-400 text-white px-2 py-1 rounded-full">Konten Dihapus</span>
                            @endif
                        </div>
                        
                        <span class="text-xs px-3 py-1 rounded-full font-semibold
                            {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($report->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>

                    <div class="bg-white p-3 rounded-lg mb-2">
                        <p class="text-sm text-gray-600 font-semibold mb-1">Alasan Laporan:</p>
                        <p class="text-sm text-[#373737]">{{ $report->reason }}</p>
                    </div>

                    <p class="text-xs text-gray-500">
                        Dilaporkan {{ \Carbon\Carbon::parse($report->created_at)->diffForHumans() }}
                    </p>
                </article>
            @empty
            <p class="text-center text-gray-500 py-8">Belum ada laporan yang dibuat.</p>
            @endforelse
        </div>
    </div>
    @endif
</section>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endpush
@endsection
