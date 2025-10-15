<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SafeSupport') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     @stack('style')
</head>
<body class="flex h-screen">

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-[#fafafa] border border-gray-200 h-full flex flex-col transition-all duration-300 w-64">
        <div class="flex items-center justify-center h-16 border-b border-gray-200 px-4">
            <a href="{{ route('counselor.dashboard') }}" class="flex items-center">
                <img src="{{ asset('img/safecenter-logo.png') }}" alt="SafeSupport Logo" class="h-8 w-auto">
                <span class="ml-2 logo-text text-gray-800 text-xl font-bold">SafeSupport</span>
            </a>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('counselor.dashboard') }}" class="flex items-center px-4 py-2 rounded-md transition
                    {{ request()->routeIs('counselor.dashboard') 
                        ? 'bg-gray-200 text-gray-900 font-semibold' 
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 {{ request()->routeIs('counselor.dashboard') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                            <rect width="7" height="9" x="3" y="3" rx="1" />
                            <rect width="7" height="5" x="14" y="3" rx="1" />
                            <rect width="7" height="9" x="14" y="12" rx="1" />
                            <rect width="7" height="5" x="3" y="16" rx="1" />
                        </svg>
                        <span class="ml-2 menu-text font-[500]">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('counselor.appointment') }}" class="flex items-center px-4 py-2 rounded-md transition
                    {{ request()->routeIs('counselor.appointment') 
                        ? 'bg-gray-200 text-gray-900 font-semibold' 
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 {{ request()->routeIs('counselor.appointment') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                            <path d="M16 14v2.2l1.6 1" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v.832" />
                            <path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h2" />
                            <circle cx="16" cy="16" r="6" />
                            <rect x="8" y="2" width="8" height="4" rx="1" />
                        </svg>
                        <span class="ml-2 menu-text font-[500]">Appointment</span>
                    </a>
                </li>
                <li x-data="{ open: false }">
                    <button type="button" class="flex items-center w-full px-4 py-2 rounded-md transition
                        {{ request()->routeIs('counselor.resources.*') 
                            ? 'bg-gray-200 text-gray-900 font-semibold' 
                            : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}" @click="open = !open">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 {{ request()->routeIs('counselor.resources.*') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                        </svg>
                        <span class="ml-2 menu-text font-[500]">Resources</span>
                        <svg class="ml-auto h-5 w-5 {{ request()->routeIs('counselor.resources.*') ? 'text-gray-900' : 'text-gray-600' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{ 'rotate-180': open }">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul class="pl-6 space-y-1" x-show="open" x-transition>
                        <li>
                            <a href="{{ route('counselor.resources.videos') }}" class="block px-4 py-2 text-sm text-gray-700 rounded-md transition {{ request()->routeIs('counselor.resources.videos') ? 'bg-gray-200 text-gray-900 font-semibold' : 'hover:bg-gray-100 hover:text-gray-900' }}">Videos</a>
                        </li>
                        <li>
                            <a href="{{ route('counselor.resources.articles') }}" class="block px-4 py-2 text-sm text-gray-700 rounded-md transition {{ request()->routeIs('counselor.resources.articles') ? 'bg-gray-200 text-gray-900 font-semibold' : 'hover:bg-gray-100 hover:text-gray-900' }}">Articles</a>
                        </li>
                        <li>
                            <a href="{{ route('counselor.resources.self-help') }}" class="block px-4 py-2 text-sm text-gray-700 rounded-md transition {{ request()->routeIs('counselor.resources.self-help') ? 'bg-gray-200 text-gray-900 font-semibold' : 'hover:bg-gray-100 hover:text-gray-900' }}">Self-Help Tools</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('counselor.schedule') }}" class="flex items-center px-4 py-2 rounded-md transition
                    {{ request()->routeIs('counselor.schedule') 
                        ? 'bg-gray-200 text-gray-900 font-semibold' 
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4b5563" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar1-icon lucide-calendar-1">
                            <path d="M11 14h1v4" />
                            <path d="M16 2v4" />
                            <path d="M3 10h18" />
                            <path d="M8 2v4" />
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                        </svg>
                        <span class="ml-2 menu-text font-[500]">Schedule</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main wrapper -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="w-full bg-[#fafafa] border border-gray-200 h-16 flex items-center px-4 justify-between shrink-0">
            <div class="flex items-center space-x-4">
                <!-- Sidebar toggle button -->
                <button id="sidebarToggle" class="text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panel-left-icon lucide-panel-left">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M9 3v18" />
                    </svg>
                </button>

                <!-- Breadcrumb -->
                <nav class="flex justify-between px-3.5 py-1 border border-neutral-200/60 rounded-md">
                    <ol class="inline-flex items-center mb-3 space-x-1 text-xs text-neutral-500 [&_.active-breadcrumb]:text-neutral-600 [&_.active-breadcrumb]:font-medium sm:mb-0">
                        @php
                            $segments = request()->segments();
                        @endphp
                        @foreach ($segments as $segment)
                            <svg class="w-5 h-5 text-gray-400/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="none">
                                    <path d="M10 8.013l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <li>
                                <a class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none {{ $loop->last ? 'active-breadcrumb cursor-default' : '' }}" href="{{ $loop->last ? '#' : url(implode('/', array_slice($segments, 0, $loop->index + 1))) }}">
                                    {{ ucfirst($segment) }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 text-pine-900 focus:outline-none">
                    <div class="w-10 h-10 overflow-hidden border border-gray-200 rounded-full">
                        <img src="{{ getUserAvatarUrl(auth()->user()) }}" alt="user" class="object-cover w-full h-full" />
                    </div>
                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                    <svg class="w-5 h-5 text-pine-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                    <a href="{{ route('counselor.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pine-100 hover:text-pine-900">Profile</a>
                    <form action="{{ route('logout') }}" method="POST" x-data>
                        @csrf
                        <button type="submit" @click="if (!confirm('Are you sure you want to logout?')) return false;" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-pine-100 hover:text-pine-900">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <div class="flex-1 flex flex-col bg-[#ffffff] overflow-hidden">
            <main class="flex-1 p-[2rem] overflow-y-auto">
                @yield('body')
            </main>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script> --}}
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>