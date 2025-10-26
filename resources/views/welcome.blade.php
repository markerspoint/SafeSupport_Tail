<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">

    <title>{{ config('app.name', 'SafeSupport') }}</title>

    <!-- Fonts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/fill.css') }}">

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

    .hero-bg-dots {
        background-image: url('{{ asset("img/background/hexgrid1.svg") }}');
        background-repeat: repeat;
        background-size: 700px;
        animation: moveNW 10s linear infinite;
    }

    @keyframes moveNW {
        0% {
            background-position: 0 0;
        }

        100% {
            background-position: -200px -200px;
        }
    }

</style>


<body>

    @include('partials.nav')

    {{-- Hero Section --}}
    <section class="relative min-h-[120vh] w-full py-24 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('img/landingpage/bg-default-1.png') }}" alt="Background" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 hero-bg-dots pointer-events-none"></div>
        <div class="absolute inset-0 bg-white/70 z-10"></div>

        <div class="relative z-20 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h1 class="mt-11 text-[2rem] sm:text-[3rem] md:text-[4rem] font-extrabold leading-tight 
                bg-gradient-to-r from-black via-gray-400 to-black bg-clip-text text-transparent">
                Listen. Heal. Grow. Live.
            </h1>

            <p class="mt-6 text-md font-[600] sm:text-[1rem] md:text-[1.3rem] text-gray-700 max-w-[44rem] mx-auto">
                Student, your feelings matter. Find the compassionate, professional counseling you need, made simple and always within reach.
            </p>

            <div class="text-center mt-6">
                <x-button text="Get Started" href="{{ route('login') }}" class="px-[4rem] py-[1.2rem] text-sm tracking-wide 
                        transform transition-transform duration-200 
                        hover:-translate-y-1 hover:shadow-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </x-button>
            </div>

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
    </section>


    {{-- Articles Marquee --}}
    <section class="relative pb-[4rem] pt-[2rem] bg-center bg-repeat bg-[length:100%_auto]" style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70"></div>

        <div class="relative z-10">
            <h2 class="text-[2.3rem] font-bold text-center mb-4">
                <span class="text-green-800">Explore</span>
                <span class="bg-gradient-to-l from-green-900 to-green-400 bg-clip-text text-transparent">Arti</span><span class="text-green-800">cles</span>

            </h2>

            <p class="text-[1.1rem] font-[600] text-green-800 text-center max-w-[50rem] mx-auto mb-[2rem]">
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

            <div class="mt-4 text-center">
                <x-button text="More Articles" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-4 shrink-0 transition-transform group-hover:-translate-y-1 group-hover:translate-x-1">
                        <path d="M7 7h10v10"></path>
                        <path d="M7 17 17 7"></path>
                    </svg>
                </x-button>
            </div>
        </div>
    </section>

    {{-- Announcement Marquee --}}
    <section class="relative pb-[8rem] pt-[2rem] bg-center bg-repeat bg-[length:100%_auto]" style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70"></div> {{-- overlay --}}

        <div class="relative z-10">
            <h2 class="text-[2.3rem] font-bold text-center mb-4">
                <span class="text-green-800">News</span>
                <span class="bg-gradient-to-r from-green-900 to-green-400 bg-clip-text text-transparent"> and </span>
                <span class="text-green-800">Updates</span>
            </h2>


            <p class="text-[1.1rem] font-[600] text-green-800 text-center max-w-[55rem] mx-auto mb-[2rem]">
                Stay up-to-date with the latest announcements, updates, and important information from SafeSupport.
            </p>

            <div class="relative w-full overflow-x-hidden py-4">
                <div x-data x-init="$nextTick(() => { $refs.content.appendChild($refs.cards.cloneNode(true)) })" class="flex animate-marquee-announcement gap-8">
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

    <section id="features" class="py-16 relative bg-center bg-repeat bg-[length:100%_auto]" style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70"></div>

        <div class="relative mx-auto max-w-6xl px-6 z-10">
            <div class="mb-12 grid gap-8 lg:grid-cols-[1fr,auto]">
                <div class="max-w-2xl">
                    <h2 class="mb-4 text-xl font-bold md:text-4xl text-green-800">
                        Your mental wellness journey<br>starts here
                    </h2>
                    <p class="text-base font-semibold text-muted-foreground md:text-lg text-green-700">
                        SafeSupport helps students access counseling, explore mental health resources, and connect with professional counselors.
                        Whether you need guidance, support, or just a safe space to talk, SafeSupport empowers you to take care of your well-being.
                    </p>
                </div>

                <div class="flex flex-col gap-2 step-fill-wrapper">
                    <div class="flex gap-4">
                        <div class="relative flex flex-col items-center">
                            <div class="relative flex h-8 w-8 flex-shrink-0 items-center justify-center overflow-hidden rounded-full bg-green-500/10">
                                <div class="step-fill animate-step-1 absolute inset-0 rounded-full"></div>
                                <span class="step-number step-number-1">1</span>
                            </div>
                            <div class="relative mt-1 h-8 w-0.5 overflow-hidden bg-green-500/20">
                                <div class="step-fill animate-step-1 absolute inset-0 bg-green-800"></div>
                            </div>
                        </div>
                        <div class="flex items-center h-8">
                            <p class="text-base"><span class="font-semibold text-foreground">Sign Up</span><span class="text-green-600"> to SafeSupport platform</span></p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="relative flex flex-col items-center">
                            <div class="relative flex h-8 w-8 flex-shrink-0 items-center justify-center overflow-hidden rounded-full bg-green-500/10">
                                <div class="step-fill animate-step-2 absolute inset-0 rounded-full"></div>
                                <span class="step-number step-number-2">2</span>
                            </div>
                            <div class="relative mt-1 h-8 w-0.5 overflow-hidden bg-green-500/20">
                                <div class="step-fill animate-step-2 absolute inset-0 bg-green-800"></div>
                            </div>
                        </div>
                        <div class="flex items-center h-8">
                            <p class="text-base"><span class="font-semibold text-foreground">Book</span><span class="text-green-600"> counseling sessions with ease</span></p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="relative flex flex-col items-center">
                            <div class="relative flex h-8 w-8 flex-shrink-0 items-center justify-center overflow-hidden rounded-full bg-green-500/10">
                                <div class="step-fill animate-step-3 absolute inset-0 rounded-full"></div>
                                <span class="step-number step-number-3">3</span>
                            </div>
                            <div class="relative mt-1 h-8 w-0.5 overflow-hidden bg-green-500/20">
                                <div class="step-fill animate-step-3 absolute inset-0 bg-green-800"></div>
                            </div>
                        </div>
                        <div class="flex items-center h-8">
                            <p class="text-base"><span class="font-semibold text-foreground">Access</span><span class="text-green-600"> mental health resources anytime</span></p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="relative flex h-8 w-8 flex-shrink-0 items-center justify-center overflow-hidden rounded-full bg-green-500/10">
                                <div class="step-fill animate-step-4 absolute inset-0 rounded-full"></div>
                                <span class="step-number step-number-4 animate-celebrate">🎉</span>
                            </div>
                        </div>
                        <div class="flex items-center h-8">
                            <p class="text-base"><span class="font-semibold text-foreground">Celebrate</span><span class="text-green-600"> your well-being and progress!</span></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mt-12">
                <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-green-800">Connect with Counselors</h3>
                    <p class="text-sm text-muted-foreground text-green-700">
                        Schedule one-on-one sessions with professional counselors to get guidance, support, and mental wellness advice.
                    </p>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 7v14"></path>
                            <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-green-800">Access Resources</h3>
                    <p class="text-sm text-muted-foreground text-green-700">
                        Explore articles, videos, and self-help tools tailored to support mental health and personal development.
                    </p>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect width="20" height="12" x="2" y="6" rx="2"></rect>
                            <circle cx="12" cy="12" r="2"></circle>
                            <path d="M6 12h.01M18 12h.01"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-green-800">Manage Appointments</h3>
                    <p class="text-sm text-muted-foreground text-green-700">
                        Keep track of your scheduled sessions, reschedule when needed, and get notified of updates from your counselors.
                    </p>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
                            <path d="M18 17V9"></path>
                            <path d="M13 17V5"></path>
                            <path d="M8 17v-3"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-green-800">Notifications & Alerts</h3>
                    <p class="text-sm text-muted-foreground text-green-700">
                        Receive reminders for upcoming sessions, new resources, and important announcements to stay on top of your mental wellness.
                    </p>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-green-800">Workshops & Events</h3>
                    <p class="text-sm text-muted-foreground text-green-700">
                        Join group sessions, mental health workshops, or school-wide events to enhance wellness and community engagement.
                    </p>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M17 8h2a2 2 0 0 1 2 2v10H3V10a2 2 0 0 1 2-2h2"></path>
                            <path d="M7 16h10"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-green-800">Support & Guidance</h3>
                    <p class="text-sm text-muted-foreground text-green-700">
                        Get help from our support team whenever you face technical issues or need assistance with your account or sessions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative pb-[4rem] bg-center bg-repeat bg-[length:100%_auto]" style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70"></div>

        <p class="font-semibold text-center text-green-700 relative">Platform build by students, for students</p>

        <div class="flex justify-center z-10">
            <div class="relative w-[27rem] sm:w-[30rem] md:w-[45rem] lg:w-[60rem] py-16 bg-[#2d6a4f] text-center text-white mt-4 rounded-2xl shadow-lg">
                <h2 class="mb-4 text-[2rem] md:text-[2.25rem] lg:text-[2.5rem] font-bold">Still have questions?</h2>
                <p class="mx-auto mb-8 px-[2rem] md:max-w-[36rem] lg:max-w-2xl text-[0.9rem] md:text-[1.1rem] lg:text-[1.3rem] text-white/90">
                    Can't find the answer you're looking for? Our team is here to help.
                </p>
                <x-button href="mailto:safesupport@gmail.com" class="inline-flex items-center px-6 py-3 !bg-green-500 border-b-4 border-green-600 transform transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                    Contact Support
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </x-button>

            </div>
        </div>
    </section>

    @include('partials.footer')
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


    /* announement marquee */
    @keyframes marquee-reverse {
        0% {
            transform: translateX(-50%);
        }

        100% {
            transform: translateX(0);
        }
    }

    .animate-marquee-announcement {
        display: flex;
        animation: marquee-reverse 20s linear infinite;
    }

</style>
