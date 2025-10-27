<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SafeSupport') }} - @yield('title')</title>
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@stack('style')

<body class="flex flex-col min-h-screen">
    <div class="relative flex-1 w-full bg-center bg-cover" style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70"></div>

        <header class="sticky top-0 z-50 w-full h-16 flex items-center justify-between px-4 border-b border-gray-200 bg-white/70 backdrop-blur-md">
            <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo" class="w-[10rem] h-[3rem] object-contain">
            </a>
        </header>

        <div x-data="{ open: false, mobileOpen: false }" class="flex flex-col md:flex-row flex-1 w-full relative">

            {{-- mobile dropdown --}}
            <div class="md:hidden w-full p-4 flex flex-col items-start">
                <button @click="mobileOpen = !mobileOpen" class="flex items-center justify-between w-full rounded-lg bg-green-600 text-white py-3 px-4 font-medium shadow-md border-b-4 border-green-900 transition">
                    <div class="flex items-center gap-2">
                        @if (request()->routeIs('student.dashboard'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-info h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        @elseif (request()->routeIs('student.chat'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-message-circle h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8Z"></path>
                        </svg>
                        @elseif (request()->routeIs('student.courses'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-book-open h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a4 4 0 0 0-4-4H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a4 4 0 0 1 4-4h6z"></path>
                        </svg>
                        @elseif (request()->routeIs('student.calendar'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-calendar h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        @elseif (request()->routeIs('student.discussions'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-users h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-menu h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                        @endif

                       {{-- active page label --}}
                        <span>
                            @if (request()->routeIs('student.dashboard'))
                            About
                            @elseif (request()->routeIs('student.chat'))
                            Chat
                            @elseif (request()->routeIs('student.courses'))
                            Courses
                            @elseif (request()->routeIs('student.calendar'))
                            Calendar
                            @elseif (request()->routeIs('student.discussions'))
                            Discussions
                            @else
                            Menu
                            @endif
                        </span>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" :class="mobileOpen ? 'rotate-180' : ''" class="lucide lucide-chevron-down h-5 w-5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                </button>

                {{-- links for dropdown --}}
                <div x-show="mobileOpen" x-transition class="mt-2 w-full flex flex-col rounded-lg border border-green-200 overflow-hidden bg-white shadow-md">
                    <a href="#" class="flex items-center gap-2 py-3 px-4 text-green-700 hover:bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-message-square h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                        Discussions
                    </a>
                    <a href="#" class="flex items-center gap-2 py-3 px-4 text-green-700 hover:bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-message-circle h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                        </svg>
                        Chat
                    </a>
                    <a href="#" class="flex items-center gap-2 py-3 px-4 text-green-700 hover:bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-book-open h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 7v14"></path>
                            <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z" />
                        </svg>
                        Courses
                    </a>
                    <a href="#" class="flex items-center gap-2 py-3 px-4 text-green-700 hover:bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-calendar h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <rect width="18" height="18" x="3" y="4" rx="2" />
                            <path d="M3 10h18" /></svg>
                        Calendar
                    </a>
                    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 py-3 px-4 {{ request()->routeIs('student.dashboard') ? 'bg-green-600 text-white border-b-4 border-green-900 shadow-lg' : 'text-green-700 hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-info h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        About
                    </a>
                </div>
            </div>

            {{-- sidebar desktop --}}
            <aside :class="open ? 'w-[12rem]' : 'w-[6rem] p-4'" class="hidden md:flex flex-col transition-all duration-300 mt-[2rem] pl-[2rem]">
                <div class="flex flex-col p-2 space-y-1 text-green-700">
                    <a href="#" class="flex items-center rounded-lg py-3 px-2 text-sm font-medium transition-colors gap-2 hover:bg-green-100" title="Discussions">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-message-square h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span x-show="open" x-transition class="whitespace-nowrap">Discussions</span>
                    </a>
                    <a href="#" class="flex items-center rounded-lg py-3 px-2 text-sm font-medium transition-colors gap-2 hover:bg-green-100" title="Chat">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-message-circle h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                        </svg>
                        <span x-show="open" x-transition class="whitespace-nowrap">Chat</span>
                    </a>
                    <a href="#" class="flex items-center rounded-lg py-3 px-2 text-sm font-medium transition-colors gap-2 hover:bg-green-100" title="Courses">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-book-open h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M12 7v14"></path>
                            <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                            </path>
                        </svg>
                        <span x-show="open" x-transition class="whitespace-nowrap">Courses</span>
                    </a>
                    <a href="#" class="flex items-center rounded-lg py-3 px-2 text-sm font-medium transition-colors gap-2 hover:bg-green-100" title="Calendar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-calendar h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                        <span x-show="open" x-transition class="whitespace-nowrap">Calendar</span>
                    </a>
                    <a href="{{ route('student.dashboard') }}" class="flex items-center rounded-lg py-3 px-2 text-sm font-medium gap-2 transition-all
                                {{ request()->routeIs('student.dashboard') 
                                    ? 'bg-green-600 text-white shadow-lg border-b-4 border-green-900' 
                                    : 'hover:bg-green-100 text-green-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-info h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 16v-4"></path>
                            <path d="M12 8h.01"></path>
                        </svg>
                        <span x-show="open" x-transition class="whitespace-nowrap">About</span>
                    </a>
                </div>

                <div class="flex justify-center p-2">
                    <button @click="open = !open" class="inline-flex items-center justify-center h-8 w-8 p-0 rounded-md text-green-700 hover:text-green-900 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="!open" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="m6 17 5-5-5-5"></path>
                            <path d="m13 17 5-5-5-5"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="open" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="m17 6-5 5 5 5"></path>
                            <path d="m10 6-5 5 5 5"></path>
                        </svg>
                    </button>
                </div>
            </aside>

            {{-- body --}}
            <main class="relative z-10 flex-1 p-8 md:p-12 overflow-y-auto">
                @yield('body')
            </main>
        </div>

        @include('partials.master-footer')
    </div>

    @stack('scripts')
</body>
</html>
