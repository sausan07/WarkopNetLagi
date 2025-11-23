<div>
    <button wire:click="toggleBookmark" class="flex items-center gap-1.5 hover:text-[#FFB347] transition-colors {{ $isBookmarked ? 'text-[#FFB347]' : 'text-gray-600' }}" title="{{ $isBookmarked ? 'Hapus dari bookmark' : 'Tambah ke bookmark' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  fill="{{ $isBookmarked ? 'currentColor' : 'none' }}"  viewBox="0 0 24 24"  stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"   d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
        </svg>
        <span>Simpan</span>
    </button>
</div>
