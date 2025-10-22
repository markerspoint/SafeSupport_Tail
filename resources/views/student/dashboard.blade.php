@extends('layout.master-student')
@section('title', 'Dashboard')

@section('body')
<!-- Banner -->
<div x-data="{
        bannerVisible: false,
        bannerVisibleAfter: 300,
    }" x-show="bannerVisible" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="-translate-y-10" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-10" x-init="setTimeout(() => { bannerVisible = true }, bannerVisibleAfter);" class="relative w-full h-auto py-2 bg-white border border-gray-200 rounded-lg shadow-sm sm:py-0 sm:h-12 mb-6" x-cloak>
    <div class="flex items-center justify-between w-full h-full px-4 mx-auto max-w-7xl">
        <a href="{{ route('student.appointments') }}" class="flex flex-col w-full h-full text-sm leading-6 text-gray-900 duration-150 ease-out sm:flex-row sm:items-center hover:text-[#10b981]">
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#10b981]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG Paths -->
                </svg>
                <strong class="font-semibold">Visit Safe Center</strong>
                <span class="hidden w-px h-4 mx-3 rounded-full sm:block bg-gray-200"></span>
            </span>
            <span class="block pt-1 pb-2 leading-none sm:inline sm:pt-0 sm:pb-0">Visit the Safe Center building onsite for personalized support and resources!</span>
        </a>
        <button @click="bannerVisible=false; setTimeout(() => { bannerVisible = true }, 1000);" class="flex items-center flex-shrink-0 justify-center w-6 h-6 p-1.5 text-gray-600 rounded-full hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<!-- Instructions Alert -->
<div x-data="{ open: true }" x-show="open" x-transition class="relative w-full rounded-lg border border-gray-200 bg-[#10b981]/10 p-4 [&>svg]:absolute [&>svg]:text-[#10b981] [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-[#10b981] mb-6">
    <!-- Minimize Button -->
    <button @click="open = false" class="absolute top-2 right-2 text-[#10b981] hover:text-[#065f46] p-1 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12h12" />
        </svg>
    </button>

    <!-- Icon -->
    <svg class="w-5 h-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
    </svg>

    <h5 class="mb-1 font-medium leading-none tracking-tight">Get Started with SafeSupport</h5>
    <div class="text-sm opacity-80">
        <ul class="list-disc list-inside space-y-1">
            <li>Click the banner above to book an in-person visit at the Safe Center.</li>
            <li>Use the <strong>Appointments</strong> card to schedule and manage counseling sessions.</li>
            <li>Explore the <strong>Resources</strong> card for videos, articles, and mental health tools.</li>
            <li>Stay updated via the <strong>Community</strong> card for workshops and events.</li>
        </ul>
    </div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card 1: Appointments -->
    <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col justify-between relative hover:shadow-sm transition">
        <div class="relative z-10 pr-28">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Appointments</h2>
            <p class="text-sm text-gray-600">Book, manage, and view your counseling appointments easily.</p>
        </div>
        <div class="absolute top-1/2 right-4 -translate-y-1/2 opacity-40 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
        </div>
        <div class="mt-4 z-10">
            <a href="{{ route('student.appointments') }}" class="text-[#10b981] font-medium hover:underline">Go to Appointments →</a>
        </div>
    </div>

    <!-- Card 2: Resources -->
    <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col justify-between relative hover:shadow-sm transition">
        <div class="relative z-10 pr-28">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Resources</h2>
            <p class="text-sm text-gray-600">Access videos, articles, and tools to support your mental health and studies.</p>
        </div>
        <div class="absolute top-1/2 right-4 -translate-y-1/2 opacity-40 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2" />
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7" />
            </svg>
        </div>
        <div class="mt-4 z-10">
            <a href="#" class="text-[#10b981] font-medium hover:underline">View Resources →</a>
        </div>
    </div>

    <!-- Card 3: Community / Announcements -->
    <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col justify-between relative hover:shadow-sm transition">
        <div class="relative z-10 pr-28">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Community</h2>
            <p class="text-sm text-gray-600">Stay updated with announcements, workshops, and student events.</p>
        </div>
        <div class="absolute top-1/2 right-4 -translate-y-1/2 opacity-40 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
        </div>
        <div class="mt-4 z-10">
            <a href="#" class="text-[#10b981] font-medium hover:underline">See Announcements →</a>
        </div>
    </div>
</div>

<!-- Counselor Schedule Card -->
<div class="bg-white border border-gray-200 rounded-xl p-6 mt-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 tracking-tight">Counselor Schedule (This Week)</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($days as $day)
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                <h3 class="text-base font-semibold text-gray-800 mb-3 capitalize">{{ $day }}</h3>

                @if(!isset($weeklySchedules[$day]) || $weeklySchedules[$day]->isEmpty())
                    <p class="text-gray-500 text-sm italic">No schedules</p>
                @else
                    <div class="space-y-2">
                        @foreach($weeklySchedules[$day] as $schedule)
                            <div class="flex items-center justify-between p-3 rounded-md text-sm font-medium text-gray-800 shadow-sm" style="background-color: {{ $schedule->color ?? '#10b981' }}20; border-left: 4px solid {{ $schedule->color ?? '#10b981' }};">
                                <span class="truncate">{{ $schedule->title }}</span>
                                <span class="text-gray-600 text-xs whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($schedule->start)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($schedule->end)->format('H:i') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection
