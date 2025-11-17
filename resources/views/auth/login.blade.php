@extends('layouts.auth')

@section('content')
<div class="flex flex-col md:flex-row max-w-4xl w-full bg-white shadow-2xl rounded-2xl overflow-hidden" x-data="{ activeForm: 'login' }">


  <div id="illustrationBlock" class="hidden md:block md:w-1/2" :class="{ 'md:order-1': activeForm === 'login', 'md:order-2': activeForm !== 'login' }">
    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085" alt="Ilustrasi" class="w-full h-full object-cover" />
  </div>


  <div id="formBlock" class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center" :class="{ 'md:order-2': activeForm === 'login', 'md:order-1': activeForm !== 'login' }">


    <div x-show="activeForm === 'login'" x-transition>
      <h2 class="text-gray-900 mb-8 text-3xl">Login</h2>
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" 
                 class="w-full p-3 rounded-full border border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 @error('email') border-red-500 @enderror" required>
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <input type="password" name="password" placeholder="Password" 
                 class="w-full p-3 rounded-full border border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 @error('password') border-red-500 @enderror" required>
          @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div class="flex justify-between items-center text-sm">
          <label><input type="checkbox" name="remember" class="mr-2">Remember me</label>
        </div>
        <button type="submit" class="w-full bg-[#F0A04B] text-gray-900 p-3 rounded-full font-semibold hover:bg-[#FCE7C8] transition-colors">Login</button>
        <p class="text-center text-sm pt-4">Belum punya akun? 
          <button type="button" @click="activeForm = 'register'" class="font-semibold hover:underline">Daftar sekarang</button>
        </p>
      </form>
    </div>

   

    
    <div x-show="activeForm === 'register'" x-transition x-cloak>
      <h2 class="text-gray-900 mb-8 text-3xl">Daftar</h2>
      <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}"
               class="w-full p-3 rounded-full border border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-500 @enderror" required>
        @error('name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}"
               class="w-full p-3 rounded-full border border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 @error('username') border-red-500 @enderror" required>
        @error('username')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
               class="w-full p-3 rounded-full border border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 @error('email') border-red-500 @enderror" required>
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        
        <input type="password" name="password" placeholder="Buat Password" 
               class="w-full p-3 rounded-full border border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 @error('password') border-red-500 @enderror" required>
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" 
               class="w-full p-3 rounded-full border border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900" required>
        
        <button type="submit" class="w-full bg-[#F0A04B] text-gray-900 p-3 rounded-full font-semibold hover:bg-[#FCE7C8] transition-colors">Daftar</button>
        <p class="text-center text-sm pt-4">Sudah punya akun? 
          <button type="button" @click="activeForm = 'login'" class="font-semibold hover:underline">Masuk di sini</button>
        </p>
      </form>
    </div>

  </div>
</div>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endpush
@endsection
