@extends('layout.master-student')
@section('title', 'Dashboard')

@section('body')

<!-- Instructions Alert -->
<div x-data="{ open: true }" x-show="open" x-transition class="relative w-full rounded-lg border border-[#1cd799] bg-gradient-to-r from-[#3cdba6]/10 to-[#36cb9c]/10 p-6 [&>svg]:absolute [&>svg]:text-[#1cd799] [&>svg]:left-6 [&>svg]:top-6 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-14 text-[#0f766e] mb-8 shadow-sm">
    <button @click="open = false" class="absolute top-4 right-4 text-[#1cd799] hover:text-[#0f766e] p-2 rounded-full hover:bg-[#1cd799]/10 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12h12" />
        </svg>
    </button>

    <svg class="w-6 h-6 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
    </svg>

    <h5 class="mb-3 font-semibold leading-none tracking-tight text-lg">Get Started with SafeSupport</h5>
    <div class="text-sm opacity-90">
        <ul class="list-disc list-inside space-y-2">
            <li>Click the banner above to book an in-person visit at the Safe Center.</li>
            <li>Use the <strong>Appointments</strong> card to schedule and manage counseling sessions.</li>
            <li>Explore the <strong>Resources</strong> card for videos, articles, and mental health tools.</li>
            <li>Stay updated via the <strong>Community</strong> card for workshops and events.</li>
        </ul>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Card 1: Appointments -->
    <div class="bg-white border border-gray-300 rounded-xl p-6 flex flex-col justify-between relative shadow-sm transition-all duration-300 group">
        <div class="relative z-10 pr-32">
            <h2 class="text-xl font-bold text-gray-700 mb-3 group-hover:text-[#1cd799] transition-colors">Appointments</h2>
            <p class="text-sm text-gray-600 leading-relaxed">Book, manage, and view your counseling appointments easily.</p>
        </div>
        <div class="absolute top-1/2 right-6 -translate-y-1/2 opacity-20 text-[#1cd799] group-hover:opacity-30 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
        </div>
        <div class="mt-6 z-10">
            <a href="{{ route('student.appointments') }}" class="inline-flex items-center text-[#1cd799] font-semibold hover:text-[#0f766e] hover:underline transition-colors">
                Go to Appointments
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Card 2: Resources -->
    <div class="bg-white border border-gray-300 rounded-xl p-6 flex flex-col justify-between relative shadow-sm transition-all duration-300 group">
        <div class="relative z-10 pr-32">
            <h2 class="text-xl font-bold text-gray-700 mb-3 group-hover:text-[#1cd799] transition-colors">Resources</h2>
            <p class="text-sm text-gray-600 leading-relaxed">Access videos, articles, and tools to support your mental health and studies.</p>
        </div>
        <div class="absolute top-1/2 right-6 -translate-y-1/2 opacity-20 text-[#1cd799] group-hover:opacity-30 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2" />
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7" />
            </svg>
        </div>
        <div class="mt-6 z-10">
            <a href="#" class="inline-flex items-center text-[#1cd799] font-semibold hover:text-[#0f766e] hover:underline transition-colors">
                View Resources
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Card 3: Community / Announcements -->
    <div class="bg-white border border-gray-300 rounded-xl p-6 flex flex-col justify-between relative shadow-sm transition-all duration-300 group">
        <div class="relative z-10 pr-32">
            <h2 class="text-xl font-bold text-gray-700 mb-3 group-hover:text-[#1cd799] transition-colors">Community</h2>
            <p class="text-sm text-gray-600 leading-relaxed">Stay updated with announcements, workshops, and student events.</p>
        </div>
        <div class="absolute top-1/2 right-6 -translate-y-1/2 opacity-20 text-[#1cd799] group-hover:opacity-30 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
        </div>
        <div class="mt-6 z-10">
            <a href="#" class="inline-flex items-center text-[#1cd799] font-semibold hover:text-[#0f766e] hover:underline transition-colors">
                See Announcements
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>

@php
$colors = ['#93C5FD', '#6EE7B7', '#C4B5FD', '#FDE68A', '#FCA5A5'];
@endphp

<!-- Counselor Schedule Card -->
<div class="bg-white border border-gray-300 rounded-xl p-8 mt-12 shadow-md">
    <h2 class="text-3xl font-bold text-gray-700 text-center mb-8 tracking-tight flex items-center justify-center">
        <svg class="w-8 h-8 mr-3 text-[#1cd799]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Counselor Schedule (This Week)
    </h2>

    <hr class="text-gray-300 mb-[2rem]">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($days as $day)
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-6 border border-gray-200 hover:border-[#1cd799]/30 transition-all duration-300 hover:shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 capitalize flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#1cd799]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $day }}
            </h3>

            @if(!isset($weeklySchedules[$day]) || $weeklySchedules[$day]->isEmpty())
            <p class="text-gray-500 text-sm italic flex items-center">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-.98-5.5-2.5" />
                </svg>
                No schedules
            </p>
            @else
            <div class="space-y-3">
                @foreach($weeklySchedules[$day] as $schedule)
                @php
                $color = $colors[array_rand($colors)];
                @endphp
                <div class="flex items-center p-4 rounded-lg text-sm font-medium text-gray-800 shadow-sm hover:shadow-md transition-all duration-200 group" style="background-color: {{ $color }}15; border-left: 5px solid {{ $color }};">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="flex-1 min-w-0">
                        <span class="truncate font-semibold block">{{ $schedule->title }}</span>
                        <span class="text-gray-600 text-xs whitespace-nowrap font-medium">
                            {{ \Carbon\Carbon::parse($schedule->start)->format('h:i A') }} -
                            {{ \Carbon\Carbon::parse($schedule->end)->format('h:i A') }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
