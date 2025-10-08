@extends('layout.master-student')
@section('title', 'Dashboard')

@section('body')
<!-- Banner -->
<div x-data="{
        bannerVisible: false,
        bannerVisibleAfter: 300,
    }" x-show="bannerVisible" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="-translate-y-10" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-10" x-init="setTimeout(() => { bannerVisible = true }, bannerVisibleAfter);" class="relative w-full h-auto py-2 bg-white border border-gray-200 rounded-lg shadow-sm sm:py-0 sm:h-12 mb-6" x-cloak>
    <div class="flex items-center justify-between w-full h-full px-4 mx-auto max-w-7xl">
        <a href="{{ route('student.appointments') }}" class="flex flex-col w-full h-full text-sm leading-6 text-gray-900 duration-150 ease-out sm:flex-row sm:items-center hover:text-pine-600">
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-pine-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" stroke="none">
                        <path d="M10.1893 8.12241C9.48048 8.50807 9.66948 9.5633 10.4691 9.68456L13.5119 10.0862C13.7557 10.1231 13.7595 10.6536 13.7968 10.8949L14.2545 13.5486C14.377 14.3395 15.4432 14.5267 15.8333 13.8259L17.1207 11.3647C17.309 11.0046 17.702 10.7956 18.1018 10.8845C18.8753 11.1023 19.6663 11.3643 20.3456 11.4084C21.0894 11.4567 21.529 10.5994 21.0501 10.0342C20.6005 9.50359 20.0352 8.75764 19.4669 8.06623C19.2213 7.76746 19.1292 7.3633 19.2863 7.00567L20.1779 4.92643C20.4794 4.23099 19.7551 3.52167 19.0523 3.82031L17.1037 4.83372C16.7404 4.99461 16.3154 4.92545 16.0217 4.65969C15.3919 4.08975 14.6059 3.39451 14.0737 2.95304C13.5028 2.47955 12.6367 2.91341 12.6845 3.64886C12.7276 4.31093 13.0055 5.20996 13.1773 5.98734C13.2677 6.3964 13.041 6.79542 12.658 6.97364L10.1893 8.12241Z" stroke="currentColor" stroke-width="1.5"></path>
                        <path d="M12.1575 9.90759L3.19359 18.8714C2.63313 19.3991 2.61799 20.2851 3.16011 20.8317C3.70733 21.3834 4.60355 21.3694 5.13325 20.8008L13.9787 11.9552" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M5 6.25V3.75M3.75 5H6.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M18 20.25V17.75M16.75 19H19.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
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
<div class="relative w-full rounded-lg border border-gray-200 bg-blue-50 p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-blue-600 mb-6">
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
    <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col justify-between relative">
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
            <a href="{{ route('student.appointments') }}" class="text-gray-600 font-medium hover:underline">Go to Appointments →</a>
        </div>
    </div>

    <!-- Card 2: Resources -->
    <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col justify-between relative">
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
            <a href="#" class="text-gray-600 font-medium hover:underline">View Resources →</a>
        </div>
    </div>

    <!-- Card 3: Community / Announcements -->
    <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col justify-between relative">
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
            <a href="#" class="text-gray-600 font-medium hover:underline">See Announcements →</a>
        </div>
    </div>
</div>
@endsection
