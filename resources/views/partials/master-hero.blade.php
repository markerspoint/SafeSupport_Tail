{{-- SafeSupport Hero Banner --}}
<div class="mx-4 sm:mx-6 lg:mx-2"> 
  <div class="relative w-full h-48 sm:h-56 md:h-64 lg:h-72 overflow-hidden group rounded-2xl shadow-sm">
    @php
        $cover = asset('img/landingpage/arbg-hd.png');
    @endphp

    <img src="{{ $cover }}" alt="SafeSupport cover"
         class="absolute inset-0 w-full h-full object-cover scale-105 transition-transform duration-700 group-hover:scale-110 rounded-2xl">

    <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-green-100/60 via-green-50/20 to-white rounded-2xl"></div>

    <div class="absolute inset-0 pointer-events-none opacity-25 rounded-2xl"
         style="background-image:
                radial-gradient(rgba(16,185,129,0.15) 1px, transparent 1.5px);
                background-size: 18px 18px;"></div>

    <div class="absolute inset-x-0 bottom-0 h-24 pointer-events-none
                bg-gradient-to-t from-white to-transparent rounded-b-2xl"></div>

    <div class="absolute inset-0 flex items-center justify-center">
      <img src="{{ asset('img/safesupport-logo.png') }}"
           alt="SafeSupport Logo"
           class="w-40 sm:w-44 md:w-52 h-auto object-contain drop-shadow-[0_8px_24px_rgba(16,185,129,0.35)]">
    </div>
  </div>
</div>
