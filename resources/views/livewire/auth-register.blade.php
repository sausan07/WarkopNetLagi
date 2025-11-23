<div>
    <h2 class="text-gray-900 mb-8 text-3xl">Daftar</h2>

<form wire:submit.prevent="submit" class="space-y-6">

    <div>
        <input type="text" wire:model="name" placeholder="Nama Lengkap" class="w-full p-3 rounded-full border border-gray-900 @error('name') border-red-500 @enderror">
        @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="text" wire:model="username" placeholder="Username" class="w-full p-3 rounded-full border border-gray-900 @error('username') border-red-500 @enderror">
        @error('username')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="email" wire:model="email" placeholder="Email" class="w-full p-3 rounded-full border border-gray-900 @error('email') border-red-500 @enderror">
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="password" wire:model="password" placeholder="Buat Password" class="w-full p-3 rounded-full border border-gray-900 @error('password') border-red-500 @enderror">
        @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="password" wire:model="password_confirmation" placeholder="Konfirmasi Password" class="w-full p-3 rounded-full border border-gray-900">
    </div>

    <button class="w-full bg-[#F0A04B] text-gray-900 p-3 rounded-full font-semibold hover:bg-[#FCE7C8] transition-colors"
        wire:loading.attr="disabled"> <span wire:loading.remove>Daftar</span> <span wire:loading>Memproses...</span>
    </button>

    <p class="text-center text-sm pt-4">Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold hover:underline">
            Masuk di sini
        </a>
    </p>

</form>


</div>
