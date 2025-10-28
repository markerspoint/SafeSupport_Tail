<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SafeSupport') }} - @yield('title')</title>
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" sizes="16x16" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@stack('style')

@php
$user = Auth::user();
@endphp

<body class="flex flex-col min-h-screen">
    <div class="relative flex-1 w-full bg-center bg-cover" style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70"></div>


        {{-- ==================== HEADER ==================== --}}
        <header class="z-50 w-full flex items-center justify-between px-4 pt-4 pb-2 bg-white/70 backdrop-blur-md relative">
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-3">
                <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo" class="w-[10rem] h-[3rem] object-contain">
            </a>

            <!-- Right side: notifications + user -->
            <div class="flex items-center space-x-2">
                <!-- Message icon -->
                <a href="{{ route('student.messages') }}" class="relative rounded-full p-2 hidden md:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle h-6 w-6 text-green-800">
                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                    </svg>
                    <span class="absolute right-1.5 top-1.5 h-2.5 w-2.5 rounded-full bg-destructive"></span>
                </a>

                <div x-data="{ showNotifications: false }" class="relative">
                    <!-- Bell icon -->
                    <button @click="showNotifications = !showNotifications" class="relative rounded-full p-2 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell h-6 w-6 text-green-800">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                        </svg>
                        <span class="notification-dot absolute right-1.5 top-1.5 h-2.5 w-2.5 rounded-full bg-destructive"></span>
                    </button>

                    <!-- Notification dropdown -->
                    <div x-show="showNotifications" @click.away="showNotifications = false" x-transition class="absolute right-0 mt-2 z-50 min-w-[8rem] overflow-hidden rounded-md border text-popover-foreground shadow-md
                                 w-96 bg-white p-0 hidden md:block">

                        <div class="flex items-center justify-between border-b px-4 py-3">
                            <h3 class="font-bold font-heading text-green-800">Notifications</h3>
                        </div>

                        <div class="relative overflow-hidden h-[450px]">
                            <div class="flex flex-col items-center justify-center py-8 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell mb-2 h-8 w-8 text-green-800">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                                </svg>
                                <p class="text-md font-sans text-green-800">No notifications</p>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- User menu -->
                <div x-data="{ dropdownOpen: false }" class="relative z-50 flex items-center">
                    <!-- Mobile hamburger -->
                    <button @click="$dispatch('open-user-drawer')" class="md:hidden flex items-center justify-center w-12 h-12 rounded-full text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Desktop avatar -->
                    <button @click="dropdownOpen = !dropdownOpen" class="hidden md:flex items-center py-2 pr-12 h-12 text-sm font-medium rounded-md transition-colors text-green-800">
                        <div class="w-10 h-10 overflow-hidden border border-gray-200 rounded-full">
                            <img src="{{ getUserAvatarUrl(auth()->user()) }}" alt="user" class="object-cover w-full h-full" />
                        </div>
                    </button>

                    <!-- Desktop dropdown (lg+ only) -->
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="hidden md:block absolute top-full right-0 mt-2 w-56 bg-white border border-gray-200 rounded-md shadow-lg z-50" x-cloak>
                        <div class="py-2">
                            <div class="flex flex-col px-3 mb-2">
                                <span class="text-sm font-bold text-green-800">{{ $user->name }}</span>
                                <span class="text-xs font-semibold text-green-800">{{ $user->email }}</span>
                            </div>

                            <!-- Menu links -->
                            <div class="px-2">
                                <a href="#" class="flex items-center w-full px-3 py-2 text-sm font-semibold text-green-800 rounded-md hover:bg-green-800 hover:text-white transition-colors duration-200">
                                    <!-- Profile icon -->
                                    <svg class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Profile
                                </a>
                            </div>

                            <div class="px-2">
                                <a href="#" class="flex items-center w-full px-3 py-2 text-sm font-semibold text-green-800 rounded-md hover:bg-green-800 hover:text-white transition-colors duration-200">
                                    <!-- Settings icon -->
                                    <svg class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    Settings
                                </a>
                            </div>

                            <div class="border-t my-1"></div>

                            <div class="px-2">
                                <a href="#" class="flex items-center w-full px-3 py-2 text-sm font-semibold text-green-800 rounded-md hover:bg-green-800 hover:text-white transition-colors duration-200">
                                    <!-- Logout icon -->
                                    <svg class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" x2="9" y1="12" y2="12" />
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        {{-- drawer --}}
        <div x-data="{ drawerOpen: false }" @open-user-drawer.window="drawerOpen = true">
            {{-- Off-canvas drawer (mobile only) --}}
            <div x-show="drawerOpen" x-transition:enter="transition transform ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition transform ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0" @click.away="drawerOpen = false" class="md:hidden fixed inset-y-0 right-0 z-[100] w-80 bg-white shadow-2xl overflow-y-auto flex flex-col justify-between" x-cloak>
                <div>
                    <div class="flex justify-end p-4">
                        <button @click="drawerOpen = false" class="text-gray-400 hover:text-gray-900 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-6 pb-4 space-y-2">
                        <a href="#" @click="drawerOpen = false" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-green-800 rounded-lg hover:bg-green-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            Profile
                        </a>

                        <a href="#" @click="drawerOpen = false" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-green-800 rounded-lg hover:bg-green-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Settings
                        </a>

                        <a href="{{ route('student.notification') }}" @click="drawerOpen = false" class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg 
                                {{ request()->routeIs('student.notification') ? 'bg-green-100 text-green-800' : 'text-green-800 hover:bg-green-50' }}">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                            </svg>
                            Notifications
                        </a>

                        <a href="{{ route('student.messages') }}" @click="drawerOpen = false" class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg 
                                {{ request()->routeIs('student.messages') ? 'bg-green-100 text-green-800' : 'text-green-800 hover:bg-green-50' }}">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                        </svg>
                            Messages
                        </a>
                    </div>
                </div>

                <div class="mt-4 mb-[3rem]">
                    <hr class="mx-6 border-gray-200">
                    <div class="px-[1.6rem] py-4">
                        <div class="flex items-center px-6 py-2 space-x-4 bg-slate-100 rounded-lg">
                            <div class="w-12 h-12 overflow-hidden border-2 border-green-200 rounded-full flex-shrink-0">
                                <img src="{{ getUserAvatarUrl(auth()->user()) }}" alt="avatar" class="object-cover w-full h-full" />
                            </div>
                            <div class="flex flex-col -mt-2">
                                <p class="text-md font-semibold text-green-800">{{ $user->name }}</p>
                                <p class="text-sm text-green-600">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 pb-6">
                        <a href="#" @click="drawerOpen = false" class="flex items-center gap-2 w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" x2="9" y1="12" y2="12" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>


            {{-- Backdrop (covers everything except drawer) --}}
            <template x-if="drawerOpen">
                <div @click="drawerOpen = false" class="md:hidden fixed inset-0 bg-black/75 z-50" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                </div>
            </template>


            <div x-data="{ open: false, mobileOpen: false }" class="flex flex-col md:flex-row flex-1 w-full relative">
                {{-- mobile version of icon --}}
                <nav class="fixed bottom-0 left-0 right-0 z-40 border-t bg-background/95 backdrop-blur-sm md:hidden" role="navigation" aria-label="Mobile navigation">
                    <div class="grid h-16 grid-cols-4" style="padding-bottom: env(safe-area-inset-bottom);">

                        <a aria-label="Go to my communities" href="#" class="relative flex flex-col items-center justify-center gap-1 text-xs font-medium transition-all duration-200 ease-in-out 
                            hover:text-foreground focus:outline-none focus:ring-2 focus:ring-inset focus:ring-success active:scale-95 
                            text-primary active" aria-current="page" data-status="active">

                            <div class="absolute inset-0 scale-75 rounded-lg bg-primary/10"></div>

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house h-5 w-5 text-green-800 transition-all duration-200 scale-110 drop-shadow-sm">
                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                                </path>
                            </svg>

                            <span class="max-w-[64px] truncate transition-all duration-200 font-semibold text-green-800">My
                                Communities</span>
                        </a>

                        <a aria-label="Browse communities" href="#" class="relative flex flex-col items-center justify-center gap-1 text-xs font-medium transition-all duration-200 ease-in-out
                            focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary active:scale-95 text-muted-foreground 
                            hover:text-muted-foreground/80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-5 w-5 text-green-800 transition-all duration-200">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="max-w-[64px] truncate transition-all duration-200 text-green-800">Communities</span>
                        </a>

                        <a aria-label="View notifications" href="{{ route('student.notification') }}" class="relative flex justify-center focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary active:scale-95">
                            <div class="flex flex-col items-center gap-1 text-xs font-medium transition-all duration-200
                                        rounded-md px-3 py-1 m-2
                                        {{ request()->routeIs('student.notification') ? 'bg-green-100 text-green-800' : 'text-green-800 hover:text-green-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell h-5 w-5 transition-all duration-200">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                                </svg>
                                <span class="max-w-[64px] truncate transition-all duration-200">Notifications</span>
                            </div>
                        </a>


                        <button aria-label="View menu" @click="drawerOpen = true" class="relative flex flex-col items-center justify-center gap-1 text-xs font-medium transition-all duration-200 ease-in-out
                            focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary active:scale-95 text-muted-foreground 
                            hover:text-muted-foreground/80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu h-5 w-5 transition-all duration-200 text-green-800">
                                <line x1="4" x2="20" y1="12" y2="12"></line>
                                <line x1="4" x2="20" y1="6" y2="6"></line>
                                <line x1="4" x2="20" y1="18" y2="18"></line>
                            </svg>
                            <span class="max-w-[64px] truncate transition-all duration-200 text-green-800">Menu</span>
                        </button>
                    </div>
                </nav>


                {{-- body --}}
                <main class="relative z-10 flex-1 p-4 sm:p-6 md:p-8 lg:p-12 overflow-hidden">
                    @yield('body')
                </main>
            </div>

            <div class="hidden md:block">
                @include('partials.master-footer')
            </div>

        </div>

        @stack('scripts')
</body>

</html>
