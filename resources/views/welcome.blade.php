<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">

    <title>{{ config('app.name', 'SafeSupport') }}</title>

    <!-- Fonts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<style>
    body {
        @apply font-sans !important;
    }

    @keyframes floatUpDown {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    .pill-animate {
        animation: floatUpDown 3s ease-in-out infinite;
    }

    .pill-animate-delay {
        animation: floatUpDown 3s ease-in-out infinite;
        animation-delay: 1.5s;
    }

    /* @keyframes slideIn {
        to {
            transform: translateX(0);
            opacity: 1;
        }
    } */

</style>

<body>

    @include('partials.nav')

    {{-- hero section --}}
    <section class="relative bg-white hero-bg min-h-[120vh] w-full py-24 overflow-hidden">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative z-20">
            <h1 class="mt-11 text-[2rem] sm:text-[3rem] md:text-[4rem] font-extrabold leading-tight 
        bg-gradient-to-r from-black via-gray-400 to-black bg-clip-text text-transparent">
                Listen. Heal. Grow. Live.
            </h1>

            <p class="mt-6 text-md sm:text-[1rem] md:text-[1.3rem] text-neutral-700 max-w-[44rem] mx-auto">
                Student, your feelings matter. Find the compassionate, professional counseling you need, made simple and always within reach.
            </p>

            <a href="{{ route('login') }}" class="mt-6 inline-flex items-center justify-center px-7 py-4 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-700 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                Get Started
            </a>

            @php
            use App\Models\User;
            $studentCount = User::where('role', 'student')->count();
            @endphp

            <div class="mt-8 flex justify-center space-x-4 relative z-20">
                <span class="pill-animate inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-neutral-700 bg-neutral-100 rounded-full hover:shadow-green-lg hover:scale-105 transition-all duration-300">
                    🎓 Join {{ number_format($studentCount) }}+ Students
                </span>
                <span class="pill-animate-delay inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-neutral-700 bg-neutral-100 rounded-full hover:shadow-green-lg hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('img/safecenter-logo.png') }}" alt="SafeSupport Logo" class="w-5 h-5 object-contain">
                    <span class="ml-2">Made for Students, by Students</span>
                </span>
            </div>
        </div>

        <div x-data="{ offset: 0 }" x-init="window.addEventListener('scroll', () => { offset = window.scrollY * 0.3 })" class="absolute left-1/2 transform -translate-x-1/2 mt-12 z-30 w-full max-w-5xl pointer-events-none">

            <img :style="`transform: translateY(-${offset}px)`" src="{{ asset('img/landingpage/hero.jpg') }}" alt="Hero Image" class="w-full rounded-xl object-cover shadow-hero-green transition-transform duration-300">
        </div>

        <div class="absolute inset-0 pointer-events-none">
            <div class="hero-bg-dots absolute inset-0"></div>
        </div>
    </section>




    {{-- Articles Marquee --}}
    <section class="relative pb-[8rem] pt-[2rem] bg-center bg-repeat bg-[length:100%_auto]" style="background-image: url('{{ asset('img/landingpage/bg-default.png') }}');">
        <div class="absolute inset-0 bg-white/85"></div> {{-- overlay --}}

        <div class="relative z-10">
            <h2 class="text-[2.3rem] font-bold text-center mb-4">
                <span class="text-green-900">Explore</span>
                <span class="bg-gradient-to-l from-green-900 to-green-400 bg-clip-text text-transparent">Arti</span><span class="text-green-900">cles</span>

            </h2>

            <p class="text-[1rem] font-[600] text-gray-500 text-center max-w-2xl mx-auto mb-[2rem]">
                Discover insightful articles, tips, and resources curated to help you grow and stay informed.
            </p>

            <div class="relative w-full overflow-x-hidden py-4">
                <div x-data x-init="$nextTick(() => { $refs.content.appendChild($refs.cards.cloneNode(true)) })" class="flex animate-marquee gap-8">
                    <div x-ref="content" class="flex gap-8">
                        <div x-ref="cards" class="flex gap-8">
                            @foreach($articles as $article)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-700 ease-out hover:border-2 hover:border-green-500 w-80 flex-shrink-0">
                                <div class="h-48 w-full relative overflow-hidden group">
                                    @php
                                    $imgPath = $article->url && \Illuminate\Support\Facades\Storage::exists('public/resources/' . $article->url)
                                    ? asset('storage/resources/' . $article->url)
                                    : asset('img/landingpage/article-default.jpg');
                                    @endphp
                                    <img src="{{ $imgPath }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                        <a class="flex items-center space-x-3">
                                            <img src="{{ asset('img/safecenter-logo.png') }}" alt="SafeSupport Logo" class="w-10 h-10 object-contain">
                                            <span class="text-xl font-bold text-white">SafeSupport</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-md font-semibold text-gray-900 mb-2 line-clamp-1">{{ $article->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $article->description }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>
</html>


<style>
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-marquee {
        display: flex;
        animation: marquee 20s linear infinite;
    }

</style>
