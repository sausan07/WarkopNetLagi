<div>
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
                Dilaporkan {{ $report->created_at->diffForHumans() }}
            </p>
        </article>
    @empty
        <p class="text-center text-gray-500 py-8">Belum ada laporan yang dibuat.</p>
    @endforelse
</div>


</div>
