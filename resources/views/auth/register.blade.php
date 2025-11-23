@extends('layouts.auth')

@section('content')
<div class="flex flex-col md:flex-row max-w-4xl w-full bg-white shadow-2xl rounded-2xl overflow-hidden">

  <div class="hidden md:block md:w-1/2 md:order-1">
    <img src="{{ asset('images/regis.png') }}" alt="" class="w-full h-full object-cover" />
  </div>

  <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center md:order-2">
    @livewire('auth-register')
  </div>

</div>
@endsection
