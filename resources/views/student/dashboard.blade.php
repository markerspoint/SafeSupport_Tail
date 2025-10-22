@extends('layout.master-student')
@section('title', 'Dashboard')

@section('body')
<!-- Banner (sidebar-offset with new color & SVG) -->
<div x-data="{
        bannerVisible: false,
        bannerVisibleAfter: 300
    }" x-show="bannerVisible" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="-translate-y-12 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-12 opacity-0" x-init="setTimeout(() => { bannerVisible = true }, bannerVisibleAfter);" class="fixed top-14 left-64 w-[calc(100%-16rem)] bg-gradient-to-r from-[#3cdba6] to-[#36cb9c] border border-[#1cd799] rounded-lg shadow-lg z-50 px-4 sm:px-6 py-3 sm:py-2 flex items-center justify-between" x-cloak>
    <a href="{{ route('student.appointments') }}" class="flex items-center gap-3 text-white text-sm sm:text-base hover:opacity-90 transition-opacity">
        <!-- New SVG -->
        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10.1893 8.12241C9.48048 8.50807 9.66948 9.5633 10.4691 9.68456L13.5119 10.0862C13.7557 10.1231 13.7595 10.6536 13.7968 10.8949L14.2545 13.5486C14.377 14.3395 15.4432 14.5267 15.8333 13.8259L17.1207 11.3647C17.309 11.0046 17.702 10.7956 18.1018 10.8845C18.8753 11.1023 19.6663 11.3643 20.3456 11.4084C21.0894 11.4567 21.529 10.5994 21.0501 10.0342C20.6005 9.50359 20.0352 8.75764 19.4669 8.06623C19.2213 7.76746 19.1292 7.3633 19.2863 7.00567L20.1779 4.92643C20.4794 4.23099 19.7551 3.52167 19.0523 3.82031L17.1037 4.83372C16.7404 4.99461 16.3154 4.92545 16.0217 4.65969C15.3919 4.08975 14.6059 3.39451 14.0737 2.95304C13.5028 2.47955 12.6367 2.91341 12.6845 3.64886C12.7276 4.31093 13.0055 5.20996 13.1773 5.98734C13.2677 6.3964 13.041 6.79542 12.658 6.97364L10.1893 8.12241Z" />
            <path d="M12.1575 9.90759L3.19359 18.8714C2.63313 19.3991 2.61799 20.2851 3.16011 20.8317C3.70733 21.3834 4.60355 21.3694 5.13325 20.8008L13.9787 11.9552" />
            <path d="M5 6.25V3.75M3.75 5H6.25" />
            <path d="M18 20.25V17.75M16.75 19H19.25" />
        </svg>

        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
            <strong class="font-semibold">Visit Safe Center</strong>
            <span class="text-xs sm:text-sm opacity-90">visit for personalized support and resources!</span>
        </div>
    </a>

    <!-- Close Button -->
    <button @click="bannerVisible=false; setTimeout(() => { bannerVisible = true }, 1000);" class="flex items-center justify-center w-6 h-6 p-1 text-white rounded-full hover:bg-white/20 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<!-- Spacer to push content down -->
<div x-show="bannerVisible" x-transition.opacity.duration.300 class="h-16 sm:h-5"></div>




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
