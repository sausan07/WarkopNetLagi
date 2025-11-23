<div>
    
    <button 
        wire:click="openModal" 
        class="text-gray-600 hover:text-red-600 transition-colors flex items-center gap-1.5"
        title="Laporkan konten ini">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
        </svg>
        <span>Laporkan</span>
    </button>


    {{-- MODAL --}}
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" 
         wire:click.self="closeModal">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6" >
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[#373737]">🚩 Laporkan Konten</h3>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="submitReport">
                <div class="mb-4">
                    <label class="block text-sm font-bold text-[#373737] mb-2">
                        Alasan Pelaporan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        wire:model="reason"
                        rows="4" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#FFB347]"
                        placeholder="Jelaskan alasan Anda melaporkan konten ini (minimal 10 karakter)..."></textarea>
                    @if($errors->has('reason'))
                        <span class="text-red-500 text-xs">{{ $errors->first('reason') }}</span> 
                    @endif
                </div>

                <div class="flex gap-3">
                    <button 
                        type="button"
                        wire:click="closeModal"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif


    {{-- TOAST NOTIFICATION (LIVEWIRE ONLY) --}}
    @if($showNotif)
        <div class="fixed top-4 right-4 z-50 px-6 py-3 rounded-xl shadow-lg text-white
            {{ $notifType === 'success' ? 'bg-green-500' : 'bg-red-500' }}">
            {{ $notifMessage }}
        </div>
    @endif

</div>
