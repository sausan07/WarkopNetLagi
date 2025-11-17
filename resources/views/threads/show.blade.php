@extends('layouts.app')

@section('content')

<x-navbar />


<main class="max-w-4xl mx-auto py-10 px-6">
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif


    <article class="bg-white border border-[#FFB347]/50 rounded-2xl shadow p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-[#373737] text-white flex items-center justify-center font-semibold">
                {{ strtoupper(substr($thread->user->username, 0, 2)) }}
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold">
                            <a href="{{ route('profile', $thread->user->username) }}" class="hover:text-[#EB5160]">
                                {{ $thread->user->username }}
                            </a>
                            <span class="text-sm text-gray-500">• {{ $thread->created_at->diffForHumans() }}</span>
                        </h3>
                        <span class="text-xs bg-[#FFB347]/20 text-[#F29F05] px-3 py-1 rounded-full inline-block mt-1">
                            #{{ $thread->category->name }}
                        </span>
                    </div>
                </div>
                
                <h1 class="mt-3 text-2xl font-utama font-bold text-[#373737]">{{ $thread->title }}</h1>
                <p class="mt-3 text-[#373737]/90 leading-relaxed whitespace-pre-line">{{ $thread->content }}</p>

             
                <div class="flex flex-wrap items-center gap-4 mt-5 text-sm text-[#373737]/70">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span>{{ $thread->posts->count() }} Balasan</span>
                    </span>

                    @livewire('bookmark-button', ['threadId' => $thread->id], key('bookmark-thread-'.$thread->id))

                    @auth
                        @livewire('report-button', ['threadId' => $thread->id], key('report-thread-'.$thread->id))
                    @endauth

                    <button onclick="shareThread()" class="hover:text-[#F29F05] flex items-center gap-1.5 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span>Bagikan</span>
                    </button>
                </div>
            </div>
        </div>
    </article>

 
    <section class="bg-[#FFFAF0] border border-[#FFB347]/40 rounded-2xl p-6 mb-8 shadow">
        <h2 class="font-bold font-utama text-lg mb-3 text-[#373737]">Balas Diskusi</h2>
        <form action="{{ route('posts.store', $thread->slug) }}" method="POST" class="space-y-4">
            @csrf
            <textarea
                name="content"
                rows="4"
                placeholder="Tulis balasan kamu di sini..."
                class="w-full rounded-xl border border-[#FFB347]/60 px-4 py-3 bg-white focus:border-[#F29F05] focus:ring-2 focus:ring-[#FF6EC7]/40 outline-none text-[#373737]"
                required
            >{{ old('content') }}</textarea>
            @if(isset($errors) && $errors->has('content'))
                <p class="text-red-500 text-sm">{{ $errors->first('content') }}</p>
            @endif
            <div class="flex justify-end gap-3">
                <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-xl text-[#373737] font-semibold transition">Batal</a>
                <button type="submit" class="px-6 py-2 bg-[#F29F05] hover:bg-[#EB5160] text-white rounded-xl font-bold transition">Kirim Balasan</button>
            </div>
        </form>
    </section>


    <section class="space-y-6">
        <h3 class="font-bold text-[#373737] font-utama text-xl mb-4">
            {{ $thread->posts->count() }} Balasan
        </h3>

        @forelse($thread->posts as $post)
        <div class="flex items-start gap-4">
            <div class="w-9 h-9 rounded-full bg-orange-500 text-white flex items-center justify-center font-bold text-sm">
                {{ strtoupper(substr($post->user->username, 0, 2)) }}
            </div>
            <div class="border rounded-2xl p-4 shadow-sm flex-1 bg-white border-[#FFB347]/40">
                
                <h4 class="font-semibold">
                    <a href="{{ route('profile', $post->user->username) }}" class="hover:text-[#EB5160]">
                        {{ $post->user->username }}
                    </a>
                    <span class="text-sm text-gray-500">• {{ $post->created_at->diffForHumans() }}</span>
                </h4>
                <p class="mt-2 text-[#373737]/90 whitespace-pre-line">{{ $post->content }}</p>
                
                <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-[#373737]/70">
                    @livewire('like-button', ['postId' => $post->id], key('like-'.$post->id))
                    @livewire('bookmark-button', ['postId' => $post->id], key('bookmark-'.$post->id))
                    @auth
                        @livewire('report-button', ['postId' => $post->id], key('report-post-'.$post->id))
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-gray-500">
            <p>Belum ada balasan. Jadilah yang pertama!</p>
        </div>
        @endforelse
    </section>

</main>

@push('scripts')
<script>
function shareThread() {
    const url = window.location.href;
    const title = "{{ $thread->title }}";
    

    copyToClipboard(url);
}

function copyToClipboard(text) {
    // Modern Clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
            showNotification('✅ Link berhasil disalin!', 'success');
        }).catch((err) => {
            console.error('Failed to copy:', err);
            fallbackCopy(text);
        });
    } else {
        // Fallback for older browsers or non-secure contexts
        fallbackCopy(text);
    }
}

function fallbackCopy(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.top = '0';
    textArea.style.left = '-9999px';
    textArea.setAttribute('readonly', '');
    document.body.appendChild(textArea);
    
    try {
        textArea.select();
        textArea.setSelectionRange(0, 99999); // For mobile devices
        
        const successful = document.execCommand('copy');
        if (successful) {
            showNotification('✅ Link berhasil disalin!', 'success');
        } else {
            showNotification('❌ Gagal menyalin link', 'error');
        }
    } catch (err) {
        console.error('Fallback copy failed:', err);
        showNotification('❌ Gagal menyalin link', 'error');
    } finally {
        document.body.removeChild(textArea);
    }
}

function showNotification(message, type = 'success') {
    // Remove existing notification if any
    const existingNotif = document.querySelector('.share-notification');
    if (existingNotif) {
        existingNotif.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'share-notification fixed top-20 right-6 px-6 py-3 rounded-xl shadow-lg z-50 animate-slide-in';
    
    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
    } else {
        notification.className += ' bg-red-500 text-white';
    }
    
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <span class="font-semibold">${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds with fade out
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 3000);
}
</script>

<style>
@keyframes slide-in {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}
</style>
@endpush
@endsection
